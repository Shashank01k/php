<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Utils\FnUtils;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /**
     * Validate password request.
     *
     * Currently this endpoint only returns CSRF information,
     * matching the existing CodeIgniter implementation.
     */
    public function validate(Request $request)
    {
        // Get request input from JSON or form data
        $password = $request->input('password', '');
        $confirmPassword = $request->input('confirmpassword', '');

        // Prevent non-string values
        if (is_array($password)) {
            $password = reset($password);
        }

        $passwordStr = (string) $password;
        $confirmPasswordStr = (string) $confirmPassword;

        try {
            return response()->json(
                FnUtils::validatePassword(
                    $passwordStr,
                    $confirmPasswordStr
                )
            );
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => [],
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_token(),
            ], 500);
        }
    }
}

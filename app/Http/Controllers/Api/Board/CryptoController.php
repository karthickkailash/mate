<?php

namespace App\Http\Controllers\Api\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CryptoController extends Controller
{
    private $cryptoService;

    public function __construct(Controller $cryptoService)
    {
        $this->cryptoService = $cryptoService;
    }

    /**
     * Encrypt data
     */
    public function encryptData(Request $request)
    {
        $request->validate(['data' => 'required|string']);
        $encryptedData = $this->cryptoService->encrypt($request->input('data'));

        return response()->json([
            'encrypted_data' => $encryptedData,
        ]);
    }

    /**
     * Decrypt data
     */
    public function decryptData(Request $request)
    {
        $request->validate(['data' => 'required|string']);
        $decryptedData = $this->cryptoService->decrypt($request->input('data'));

        if ($decryptedData === null) {
            return response()->json(['error' => 'Invalid or tampered data'], 400);
        }

        return response()->json([
            'decrypted_data' => $decryptedData,
        ]);
    }

    /**
     * Covert Decrypt check.
     *
     * \Illuminate\Http\Request
     * @return mixed
     */
    public function convert_decrypt(Request $request)
    {
        $data = $this->dec($request->data);
        return $data;
    }
    /**
     * Convert Encrypt check.
     *
     * \Illuminate\Http\Request
     * @return mixed
     */
    public function convert_encrypt(Request $request)
    {
        $data = $this->enc($request->data);
        return $data;
    }
}
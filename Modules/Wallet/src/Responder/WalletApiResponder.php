<?php

namespace Wallet\Responder;

use Wallet\Http\Resources\WalletResource;
use Wallet\Support\WalletMessage;
use Symfony\Component\HttpFoundation\Response;

use function response;

class WalletApiResponder
{
    public function list($wallets)
    {
        return WalletResource::collection($wallets);
    }

    public function adminMedicalCenterList($wallets)
    {
        return WalletResource::collection($wallets);
    }

    public function validationFailed(array $messages)
    {
        return response()->json([
            'status' => 'error',
            'message' => $messages,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function storedSuccessfully($wallet)
    {
        return response()->json([
            'status' => 'success',
            'message' => WalletMessage::$walletSavedSuccessfully,
            'data' => [
                'wallet' => $wallet,
            ],
        ]);

    }

    public function updatedSuccessfully($wallet)
    {
        return response()->json([
            'status' => 'success',
            'message' => WalletMessage::$walletUpdatedSuccessfully,
            'data' => [
                'wallet' => $wallet,
            ],
        ]);

    }

    public function deletedSuccessfully($wallet)
    {
        return response()->json([
            'status' => 'success',
            'message' => WalletMessage::$walletDeletedSuccessfully,
            'data' => [
                'wallet' => $wallet,
            ],
        ]);

    }
    public function restoredSuccessfully()
    {
        return response()->json([
            'status' => 'success',
            'message' => WalletMessage::$walletRestoredSuccessfully,
        ]);
    }

}

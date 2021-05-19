<?php


namespace App\Repositories\Transaction;


use App\Exceptions\CaboDinheiroException;
use App\Exceptions\TransactionDeniedException;
use App\Models\Retailer;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\InvalidDataProviderException;

class TransactionRepository
{
    public function handle(array $data): array
    {
        if (!$this->guardCanTransfer()) {
            throw new TransactionDeniedException('Retailer is not authorized to make transactions', 401);
        }

        $model = $this->getProvider($data['provider']);

        $user = $model->findOrFail($data['payee_id']);

        if (!$this->checkUserBalance($user, $data['amount'])) {
            throw new CaboDinheiroException('irmao vc n tem dinheiro', 422);
        }

        return [];
    }

    public function guardCanTransfer(): bool
    {
        if (Auth::guard('users')->check()) {
            return true;
        } else if (Auth::guard('retailer')->check()) {
            return false;
        } else {
            throw new InvalidDataProviderException('Provider Not found');
        }
    }

    public function getProvider(string $provider)
    {
        if ($provider == "user") {
            return new User();
        } else if ($provider == "retailer") {
            return new Retailer();
        } else {
            throw new InvalidDataProviderException('Provider Not found');
        }
    }

    private function checkUserBalance($user, $money)
    {
        return $user->wallet->balance >= $money;
    }
}

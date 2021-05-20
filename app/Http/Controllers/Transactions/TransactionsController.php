<?php


namespace App\Http\Controllers\Transactions;


use App\Exceptions\CaboDinheiroException;
use App\Exceptions\IdleServiceException;
use App\Exceptions\TransactionDeniedException;
use App\Http\Controllers\Controller;
use App\Repositories\Transaction\TransactionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\InvalidDataProviderException;

class TransactionsController extends Controller
{
    /**
     * @var TransactionRepository
     */
    private $repository;

    public function __construct(TransactionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function postTransaction(Request $request)
    {
        $this->validate($request, [
            'provider' => 'required|in:users,retailers',
            'payee_id' => 'required',
            'amount' => 'required|numeric'
        ]);

        $fields = $request->only(['provider', 'payee_id', 'amount']);
        try {
            $result = $this->repository->handle($fields);
            return response()->json($result);
        } catch (InvalidDataProviderException | CaboDinheiroException $exception) {
            return response()->json(['errors' => ['main' => $exception->getMessage()]], $exception->getCode());
        } catch (TransactionDeniedException | IdleServiceException $exception) {
            return response()->json(['errors' => ['main' => $exception->getMessage()]], 401);
        } catch (\Exception $exception) {
            Log::critical('[Transaction Gone So Fucking Wrong plz call the cops]', [
                'message' => $exception->getMessage()
            ]);
        }
    }
}

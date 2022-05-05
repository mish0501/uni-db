<?php

namespace App\Services;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ClientsService
{
    public static function getClients()
    {
        return Client::with('user:id,name,email,phone')->get();
    }

    public static function storeClient(StoreClientRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'address' => $request->address,
                'PID' => $request->pid,
            ]);

            $client = Client::create([
                'user_id' => $user->id,
            ]);

            if ($client) {
                DB::commit();

                return Redirect::route('clients.index')
                    ->with('message', 'Client created successfully')
                    ->with('type', 'success');
            }

            throw new Exception('Client creation failed');
        } catch (Exception $e) {
            DB::rollBack();

            return Redirect::route('clients.index')
                ->with('message', $e)
                ->with('type', 'error');
        }
    }

    public static function updateClient(UpdateClientRequest $request, Client $client)
    {
        try {
            DB::beginTransaction();

            $user = $client->user;

            $user->name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->PID = $request->pid;

            if ($request->password) {
                $user->password = bcrypt($request->password);
            }

            $user->save();
            $client->save();

            DB::commit();

            return Redirect::route('clients.index')
                ->with('message', 'Client updated successfully')
                ->with('type', 'success');
        } catch (Exception $e) {
            DB::rollBack();

            return Redirect::back()
                ->with('message', 'Client update failed')
                ->with('type', 'error');
        }
    }

    public static function deleteClient(Client $client)
    {
        try {
            DB::beginTransaction();

            $client->delete();

            DB::commit();

            return Redirect::route('clients.index')
                ->with('message', 'Client deleted successfully')
                ->with('type', 'success');
        } catch (Exception $e) {
            DB::rollBack();

            return Redirect::route('clients.index')
                ->with('message', 'Client delete failed')
                ->with('type', 'error');
        }
    }
}

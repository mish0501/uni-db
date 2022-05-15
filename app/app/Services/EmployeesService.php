<?php

namespace App\Services;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class EmployeesService
{
    public static function getEmployees()
    {
        return Employee::with('user:id,name,email,phone')
            ->with('position:id,name')
            ->get();
    }

    public static function storeEmployee(StoreEmployeeRequest $request)
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

            $employee = Employee::create([
                'user_id' => $user->id,
                'position_id' => $request->position,
            ]);

            if ($employee) {
                DB::commit();

                return Redirect::route('Employees.index')
                    ->with('message', 'Employee created successfully')
                    ->with('type', 'success');
            }

            throw new Exception('Employee creation failed');
        } catch (Exception $e) {
            DB::rollBack();

            return Redirect::route('Employees.index')
                ->with('message', $e)
                ->with('type', 'error');
        }
    }

    public static function updateEmployee(UpdateEmployeeRequest $request, Employee $employee)
    {
        try {
            DB::beginTransaction();

            $user = $employee->user;

            $user->name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->PID = $request->pid;

            if ($request->password) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            $employee->position_id = $request->position;
            $employee->save();

            DB::commit();

            return Redirect::route('Employees.index')
                ->with('message', 'Employee updated successfully')
                ->with('type', 'success');
        } catch (Exception $e) {
            DB::rollBack();

            return Redirect::back()
                ->with('message', 'Employee update failed')
                ->with('type', 'error');
        }
    }

    public static function deleteEmployee(Employee $employee)
    {
        try {
            DB::beginTransaction();

            $employee->delete();

            DB::commit();

            return Redirect::route('Employees.index')
                ->with('message', 'Employee deleted successfully')
                ->with('type', 'success');
        } catch (Exception $e) {
            DB::rollBack();

            return Redirect::route('Employees.index')
                ->with('message', 'Employee delete failed')
                ->with('type', 'error');
        }
    }
}

<?php

namespace App\Modules\Users\Http\Repositories;

use App\Modules\Users\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public static function create(Array $params)
    {
        try {
            DB::beginTransaction();

            $user = User::create($params);
            DB::commit();

            return [
                'success' => true,
                'data' => $user,
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}

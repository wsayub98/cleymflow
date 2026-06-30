<?php

use App\Modules\Employees\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Claims extends Model
{
    protected $fillable = [
        'employee_id',
        'amount',
        'reason',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
    * @return BelongsTo
    */
    public function employee() : BelongsTo
    {
        // Employee_id foreign key in table claims; id primary key in table employees.
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}

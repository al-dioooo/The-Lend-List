<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataList extends Model
{
    use HasFactory, SoftDeletes;

    public function getCreatedAtAttribute($value)
    {
        if ($value != null) {
            return Carbon::parse($value)->isoFormat('D MMMM YYYY');
        }
    }

    public function getBorrowedAtAttribute($value)
    {
        if ($value != null) {
            return Carbon::parse($value)->isoFormat('D MMMM YYYY');
        }
    }

    public function getUpdatedAtAttribute($value)
    {
        if ($value != null) {
            return Carbon::parse($value)->isoFormat('D MMMM YYYY');
        }
    }

    public function getReturnedAtAttribute($value)
    {
        if ($value != null) {
            return Carbon::parse($value)->isoFormat('D MMMM YYYY');
        }
    }

    public function borrower()
    {
        return $this->belongsTo(Borrower::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'data_list_item');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->whereHas('borrower', function ($q) {
                $q->where('name', 'like', '%' . request('search') . '%')->orWhere('email', 'like', '%' . request('search') . '%');
            })->orWhereHas('items', function ($q) {
                $q->where('name', 'like', '%' . request('search') . '%')->orWhere('description', 'like', '%' . request('search') . '%');
            })->orWhere('unique_id', 'like', '%' . request('search') . '%')->with('borrower:id,name,email,contact', 'items:id,name,description')->latest();
        });
    }

    public function scopeReportFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query) {
            $query->whereHas('borrower', function ($q) {
                $q->where('name', 'like', '%' . request('search') . '%')->orWhere('email', 'like', '%' . request('search') . '%');
            })->orWhereHas('items', function ($q) {
                $q->where('name', 'like', '%' . request('search') . '%')->orWhere('description', 'like', '%' . request('search') . '%');
            })->orWhere('unique_id', 'like', '%' . request('search')  . '%');
        })->when($filters['month'] ?? null, function ($query, $month) {
            $query->whereMonth('created_at', $month);
        })->when($filters['year'] ?? null, function ($query, $year) {
            $query->whereYear('created_at', $year);
        });
    }
}

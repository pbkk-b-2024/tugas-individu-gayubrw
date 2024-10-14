<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Review extends Model
{
    use HasFactory;

    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->integer('rating');
            $table->text('comment');
            $table->timestamps();
        });
    }

    // Tambahkan properti yang diizinkan untuk mass assignment
    protected $fillable = ['product_id', 'user_id', 'rating', 'comment'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }

}

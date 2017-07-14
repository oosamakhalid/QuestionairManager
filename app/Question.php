<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\QuestionChoice;
class Question extends Model
{
    protected $fillable = [
        'text', 'type','answer', 'questionair_id','created_at','updated_at'
    ];
    //one to many relationship with Questions
    public function choices()
    {
		return	$this->hasMany(QuestionChoice::class);
    }
}

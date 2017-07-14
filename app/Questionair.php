<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Questions;
class Questionair extends Model
{
    protected $fillable = [
        'name', 'duration','timeType', 'resumeable','publish','created_at','updated_at'
    ];
    //one to many relationship with Questions
    public function Questions()
    {
		return	$this->hasMany(Question::class);
    }
    public function tQuestionss()
    {
        return $this->hasMany(Question::class)->count();
    }
}

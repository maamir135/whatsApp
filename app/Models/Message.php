<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Message extends Model
{
    //
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'file_name',
        'file_original_name',
        'folder_path',
        'file_type',
        'is_read',
    ];

    protected $appends = ['formatted_date'];

    public function getFormattedDateAttribute() {
        $date = Carbon::parse($this->created_at)->timezone('Asia/Karachi');
        return $date->isToday() ? 'Today' : ($date->isYesterday() ? 'Yesterday' : $date->format('d-m-y'));
    }



    public function sender() {
        return $this->belongsTo(User::class, 'sender_id', 'id'); 
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id', 'id'); 
    }

       /**
     * Mutator to encrypt message before saving to DB
     */
    public function setMessageAttribute($value) {
        $this->attributes['message'] = Crypt::encryptString($value);
    }

    /**
     * Accessor to decrypt message when retrieved
     */
    public function getMessageAttribute($value){
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->timezone('Asia/Karachi');
    }

}

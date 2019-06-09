<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Model;

class ClientSetting extends Model
{

	protected $fillable = ['id', 'client_id', 'event', 'start_id_order', 'number_sheets', 'note', 'email_from', 'email_subject', 'email_note'];


	public function client()
	{
		return $this->belongsTo(Client::class);
	}

}

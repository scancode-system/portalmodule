<?php

namespace Modules\Portal\Entities;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{

	protected $fillable = ['id', 'company_id', 'event', 'start_id_order', 'number_sheets', 'note', 'email_from', 'email_subject', 'email_note'];

}

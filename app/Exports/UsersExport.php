<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\User;
//use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    private $date_to;
    private $date_from;
    private $search_id;
    private $search_phone;
    private $search_ip;
    private $sort_type;

    public function __construct($date_from, $date_to, $search_id, $search_phone, $search_ip, $sort_type)
    {
        $this->date_from = $date_from;
        $this->date_to = $date_to;
        $this->search_id = $search_id;
        $this->search_phone = $search_phone;
        $this->search_ip = $search_ip;
        $this->sort_type = $sort_type;
    }

    public function map($user): array
    {
        return [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone' => $user->phone,
            'ip' => $user->ip,
            'registered_date' => $user->created_at,
            'last_activity' => $user->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            '# ID',
            'Имя',
            'Фамилия',
            'Телефон',
            'IP',
            'Дата регистрации',
            'Дата последней активности',
        ];
    }

    public function query()
    {
        $users = User::query()->latest('id')
            ->steped();

        if (!is_null($this->date_from)) {
            $users = $users->filterByDate($this->date_from, $this->date_to, $this->sort_type);
        }

        if (!is_null($this->search_id) || !is_null($this->search_phone) || !is_null($this->search_ip)) {
            $users = $users->search($this->search_id, $this->search_phone, $this->search_ip);
        }

        return $users;
    }
}

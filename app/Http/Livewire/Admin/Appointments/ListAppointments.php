<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appointment;

class ListAppointments extends AdminComponent
{
    public $appointment_id;
    public $status = null;
    protected  $queryString = ['status'];

    protected $listeners = [
        'confirm_destroy' => 'confirm_destroy'
    ];

    public function destroy($appointment_id)
    {
        $this->appointment_id = $appointment_id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function confirm_destroy()
    {
        $data = Appointment::findOrFail($this->appointment_id);
        $data->delete();

        $this->dispatchBrowserEvent('deleted', ['message' => 'Appointment deleted successfully.']);
    }

    public function filter_by_status($status = null)
    {
        $this->resetPage();
        $this->status = $status;
    }

    public function render()
    {
        $appointments = Appointment::with([
            'client'
        ])
            ->when($this->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(5);

        $total_appointment = Appointment::count();
        $scheduled_appointment = Appointment::where('status', 'scheduled')->count();
        $closed_appointment = Appointment::where('status', 'closed')->count();

        return view('livewire.admin.appointments.list-appointments', [
            'appointments' => $appointments,
            'total_appointment' => $total_appointment,
            'scheduled_appointment' => $scheduled_appointment,
            'closed_appointment' => $closed_appointment,
        ]);
    }
}

<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appointment;

class ListAppointments extends AdminComponent
{
    public $appointment_id;

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

    public function render()
    {
        $appointments = Appointment::with([
            'client'
        ])
            ->latest()
            ->paginate(5);

        return view('livewire.admin.appointments.list-appointments', [
            'appointments' => $appointments
        ]);
    }
}

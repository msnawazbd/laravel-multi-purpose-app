<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appointment;
use function Livewire\str;

class ListAppointments extends AdminComponent
{
    public $appointment_id;
    public $status = null;
    protected  $queryString = ['status'];
    public $selected_rows = [];
    public $selectPageRows = false;

    protected $listeners = [
        'confirm_destroy' => 'confirm_destroy'
    ];

    public function updatedSelectPageRows($value)
    {
        if($value) {
            $this->selected_rows = $this->appointments->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selected_rows', 'selectPageRows']);
        }
    }

    public function getAppointmentsProperty()
    {
        return Appointment::with([
            'client'
        ])
            ->when($this->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(5);
    }

    public function deleteSelectedRows()
    {
        Appointment::whereIn('id', $this->selected_rows)->delete();

        $this->dispatchBrowserEvent('deleted', ['message' => 'All selected appointment got deleted.']);

        $this->reset(['selected_rows', 'selectPageRows']);
    }

    public function markAllAsScheduled()
    {
        Appointment::whereIn('id', $this->selected_rows)->update(['status' => 'SCHEDULED']);

        $this->dispatchBrowserEvent('updated', ['message' => 'Appointments marked as scheduled']);
        $this->reset(['selected_rows', 'selectPageRows']);
    }

    public function markAllAsClosed()
    {
        Appointment::whereIn('id', $this->selected_rows)->update(['status' => 'CLOSED']);

        $this->dispatchBrowserEvent('updated', ['message' => 'Appointments marked as closed']);
        $this->reset(['selected_rows', 'selectPageRows']);
    }

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
        $appointments = $this->appointments;

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

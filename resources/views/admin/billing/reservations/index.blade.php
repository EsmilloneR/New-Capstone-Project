@extends('layouts.admin')

@section('title', 'Records')

@section('content')
    <x-users>
        <div class="mb-4">
            <h5>Guest's Reservations</h5>
            <div class="card mb-3">
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="col">#</th>
                                    <th class="col">Name</th>
                                    <th class="col">Ref. Number</th>
                                    <th class="col">Payment Method</th>
                                    <th class="col">Payment Status</th>
                                    <th class="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guests as $guest)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                {{ $guest->user->name }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-center">
                                                {{ $guest->reference_number }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-center">
                                                {{ ucfirst($guest->payment_method) }}
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-medium mb-auto">
                                                <span
                                                    class="badge
                                                    @if ($guest->payment_status === 'paid') bg-success
                                                    @elseif ($guest->payment_status === 'pending') bg-warning
                                                    @elseif ($guest->payment_status === 'canceled') bg-danger
                                                    @elseif($guest->payment_status === 'failed') bg-dark @endif">
                                                    {{ ucfirst($guest->payment_status) }}
                                                </span>
                                            </p>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                @if ($guest->payment_status !== 'paid')
                                                    <form action="{{ route('admin.billing.accept', $guest->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="btn btn-success d-flex align-items-center"><img
                                                                src="{{ asset('images/svg/accept.svg') }}"
                                                                class="svg-link img-fluid">Accept</button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.billing.cancel', $guest->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="btn btn-danger d-flex align-items-center"><img
                                                            src="{{ asset('images/svg/cancel.svg') }}"
                                                            class="svg-link img-fluid">Cancel</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="pagination">
                {{ $guests->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </x-users>
@endsection

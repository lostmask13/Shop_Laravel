@extends('layout.admin', ['title' => 'Order edit'])

@section('content')
    <h1 class="mb-4"Edit order</h1>
    <form method="post" action="{{ route('admin.order.update', ['order' => $order->id]) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            @php($status = old('status') ?? $order->status ?? 0)
            <select name="status" class="form-control" title="Order status">
            @foreach ($statuses as $key => $value)
                <option value="{{ $key }}" @if ($key == $status) selected @endif>
                    {{ $value }}
                </option>
            @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Name, surname"
                   required maxlength="255" value="{{ old('name') ?? $order->name ?? '' }}">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email"
                   required maxlength="255" value="{{ old('email') ?? $order->email ?? '' }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phone" placeholder="Phone"
                   required maxlength="255" value="{{ old('phone') ?? $order->phone ?? '' }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="address" placeholder="Address"
                   required maxlength="255" value="{{ old('address') ?? $order->address ?? '' }}">
        </div>
        <div class="form-group">
    <textarea class="form-control" name="comment" placeholder="Comments"
              maxlength="255" rows="2">{{ old('comment') ?? $order->comment ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>
@endsection


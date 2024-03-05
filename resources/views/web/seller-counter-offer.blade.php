@extends('web.master-no-header')
@section('page_title','Counter Offer')
@section('web.main')
@livewire('web.counter-offer',['id'=>$id])
@endsection

@extends('layouts.master')

@section('title')
	<title>Checkout</title>
@endsection

@push('css')
	<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}" />
@endpush

@section('content')
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">Checkout</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('order.transaksi') }}">Transaksi</a></li>
                            <li class="breadcrumb-item active">Checkout</li>
                        </ol>
					</div>
				</div>
			</div>
		</div>

		<section class="content" id="ris">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-8">
						@component('components.card')
							@slot('title')
								<h4 class="card-title">Data Pelanggan</h4>
							@endslot

							<!-- Jika Value dari message ada, maka alert success akan ditampilkan -->
							<div v-if="message" class="alert alert-success">
								Transaksi telah disimpan, Invoice: <strong>#@{{ message }}</strong>
							</div>
							<div class="form-group">
								<label for="">Email</label>
								<input type="text" name="email"
									v-model="customer.email"
									class="form-control"
									@keyup.enter.prevent="searchCustomer"
									required 
								>
								<p>Tekan enter untuk mengecek email.</p>
								<!-- EVENT KETIKA TOMBOL ENTER DITEKAN, MAKA AKAN MEMANGGIL METHOD searchCustomer dari Vuejs -->
							</div>

							<!-- JIKA formCustomer BERNILAI TRUE, MAKA FORM AKAN DITAMPILKAN -->
							<div v-if="formCustomer">
								<div class="form-group">
									<label for="">Nama Pelanggan</label>
									<input type="text" name="name"
										v-model="customer.name"
										:disabled="resultStatus"
										class="form-control" required>
								</div>
								<div class="form-group">
									<label for="">Alamat</label>
									<textarea name="address"
										class="form-control"
										:disabled="resultStatus"
										v-model="customer.address"
										cols="5" rows="5" required></textarea>		
								</div>
								<div class="form-group">
									<label for="">No Telp</label>
									<input type="text" name="phone"
									v-model="customer.phone"
									:disabled="resultStatus"
									class="form-control" required>
								</div>
							</div>
						@slot('footer')
							<div class="card-footer text-muted">
								<!-- JIKA VALUE DARI errorMessage ada, maka alert danger akan ditampilkan -->
								<div v-if="errorMessage" class="alert alert-danger">
									@{{ errorMessage }}
								</div>
								<!-- JIKA TOMBOL DITEKAN MAKA AKAN MEMANGGIL METHOD sendOrder -->
								<button class="btn btn-primary btn-sm float-right"
									:disabled="submitForm"
									@click.prevent="sendOrder">
									@{{ submitForm ? 'Loading...':'Order Now' }}
								</button>
							</div>
						@endslot
						@endcomponent
					</div>

					@include('orders.cart')
				
				</div>
			</div>
		</section>
	</div>
@endsection
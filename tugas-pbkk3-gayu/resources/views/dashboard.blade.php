@extends('layouts.app')

@section('content')
                <!-- Bagian produk -->
                <div class="container mx-auto px-4 sm:px-8">
                    <div class="py-8">
                        <div class="flex flex-col md:flex-row items-center justify-between mb-8">
                            <div class="w-full">
                                <a href="{{ route('products.index') }}" class="block transition duration-300 ease-in-out transform hover:scale-105">
                                    <img src="{{ asset('img/catharsis2.jpg') }}" alt="Catharsis Empire" class="w-full h-auto shadow-lg rounded-lg">
                                </a>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="col-span-1 relative group">
                                <img src="{{ asset('img/catharsis510.png') }}" alt="Mytha" class="block transition duration-300 ease-in-out transform hover:scale-105">
                                <div class="absolute bottom-0 left-0 right-0 p-4 bg-black bg-opacity-50 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <h3 class="text-lg font-semibold">Catharsis EMPIRE x 510 - Repertoire</h3>
                                    <p>Boxy Hoodie</p>
                                </div>
                            </div>
                            <div class="col-span-1 relative group">
                                <img src="{{ asset('img/varsity.png') }}" alt="Walls Of Jericho" class="block transition duration-300 ease-in-out transform hover:scale-105">
                                <div class="absolute bottom-0 left-0 right-0 p-4 bg-black bg-opacity-50 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <h3 class="text-lg font-semibold">Catharsis REBORN - Adieu</h3>
                                    <p>Varsity</p>
                                </div>
                            </div>
                            <div class="col-span-1 relative group">
                                <img src="{{ asset('img/jogger.png') }}" alt="Genesis" class="block transition duration-300 ease-in-out transform hover:scale-105">
                                <div class="absolute bottom-0 left-0 right-0 p-4 bg-black bg-opacity-50 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <h3 class="text-lg font-semibold">Catharsis EMPIRE - Magnus</h3>
                                    <p>Jogger Pants</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection

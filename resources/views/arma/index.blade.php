@extends('layouts.app')

@section('title', 'Arma tu Sushi')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold text-danger text-center mb-4">Arma tu Sushi</h1>

    <form id="armaForm" action="{{ route('arma.agregar') }}" method="POST">
        @csrf

        <!-- Tabs -->
        <ul class="nav nav-pills nav-justified mb-4" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="base-tab" data-bs-toggle="pill" data-bs-target="#base" type="button" role="tab">Base</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="proteinas-tab" data-bs-toggle="pill" data-bs-target="#proteinas" type="button" role="tab">Proteínas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="vegetales-tab" data-bs-toggle="pill" data-bs-target="#vegetales" type="button" role="tab">Vegetales</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="envoltura-tab" data-bs-toggle="pill" data-bs-target="#envoltura" type="button" role="tab">Envoltura</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="confirmar-tab" data-bs-toggle="pill" data-bs-target="#confirmar" type="button" role="tab">Confirmar</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">

            <!-- Base -->
            <div class="tab-pane fade show active" id="base" role="tabpanel">
                <div class="mb-4">
                    <h4 class="fw-bold">Elige una Base</h4>
                    @foreach($bases as $base)
                    <div class="form-check mb-2">
                        <input class="form-check-input base-input" type="radio" name="base" value="{{ $base->id }}" data-nombre="{{ $base->nombre }}" data-precio="{{ $base->precio }}" required>
                        <label class="form-check-label">
                            {{ $base->nombre }} (+${{ number_format($base->precio, 0, ',', '.') }})
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="text-end">
                    <button class="btn btn-primary" type="button" onclick="nextTab('proteinas-tab')">Siguiente</button>
                </div>
            </div>

            <!-- Proteínas -->
            <div class="tab-pane fade" id="proteinas" role="tabpanel">
                <div class="mb-4">
                    <h4 class="fw-bold">Elige hasta 2 Proteínas</h4>
                    @foreach($proteinas as $proteina)
                    <div class="form-check mb-2">
                        <input class="form-check-input proteina-input" type="checkbox" name="proteinas[]" value="{{ $proteina->id }}" data-nombre="{{ $proteina->nombre }}" data-precio="{{ $proteina->precio }}">
                        <label class="form-check-label">
                            {{ $proteina->nombre }} (+${{ number_format($proteina->precio, 0, ',', '.') }})
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-secondary" type="button" onclick="nextTab('base-tab')">Atrás</button>
                    <button class="btn btn-primary" type="button" onclick="nextTab('vegetales-tab')">Siguiente</button>
                </div>
            </div>

            <!-- Vegetales -->
            <div class="tab-pane fade" id="vegetales" role="tabpanel">
                <div class="mb-4">
                    <h4 class="fw-bold">Elige hasta 3 Vegetales</h4>
                    @foreach($vegetales as $vegetal)
                    <div class="form-check mb-2">
                        <input class="form-check-input vegetal-input" type="checkbox" name="vegetales[]" value="{{ $vegetal->id }}" data-nombre="{{ $vegetal->nombre }}" data-precio="{{ $vegetal->precio }}">
                        <label class="form-check-label">
                            {{ $vegetal->nombre }} (+${{ number_format($vegetal->precio, 0, ',', '.') }})
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-secondary" type="button" onclick="nextTab('proteinas-tab')">Atrás</button>
                    <button class="btn btn-primary" type="button" onclick="nextTab('envoltura-tab')">Siguiente</button>
                </div>
            </div>

            <!-- Envoltura -->
            <div class="tab-pane fade" id="envoltura" role="tabpanel">
                <div class="mb-4">
                    <h4 class="fw-bold">Elige una Envoltura</h4>
                    @foreach($envolturas as $envoltura)
                    <div class="form-check mb-2">
                        <input class="form-check-input envoltura-input" type="radio" name="envoltura" value="{{ $envoltura->id }}" data-nombre="{{ $envoltura->nombre }}" data-precio="{{ $envoltura->precio }}" required>
                        <label class="form-check-label">
                            {{ $envoltura->nombre }} (+${{ number_format($envoltura->precio, 0, ',', '.') }})
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-secondary" type="button" onclick="nextTab('vegetales-tab')">Atrás</button>
                    <button class="btn btn-primary" type="button" onclick="prepareResumen()">Siguiente</button>
                </div>
            </div>

            <!-- Confirmar -->
            <div class="tab-pane fade" id="confirmar" role="tabpanel">
                <div class="mb-4">
                    <h4 class="fw-bold">Confirma tu Sushi</h4>
                    <ul class="list-group mb-4" id="resumen-lista">
                        <!-- Aquí se cargará dinámicamente el resumen -->
                    </ul>
                    <h3 class="fw-bold text-end" id="precio-total"></h3>
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-secondary" type="button" onclick="nextTab('envoltura-tab')">Atrás</button>
                    <button type="submit" class="btn btn-success btn-lg">Agregar al Carrito</button>
                </div>
            </div>

        </div>

    </form>
</div>

@push('scripts')
<script>
    function nextTab(tabId) {
        var triggerEl = document.querySelector('#' + tabId);
        bootstrap.Tab.getOrCreateInstance(triggerEl).show();
    }

    function prepareResumen() {
        let resumenLista = document.getElementById('resumen-lista');
        let precioTotal = 0;
        resumenLista.innerHTML = '';

        // Base
        const base = document.querySelector('.base-input:checked');
        if (base) {
            resumenLista.innerHTML += `<li class="list-group-item">Base: ${base.dataset.nombre} (+$${parseInt(base.dataset.precio).toLocaleString('es-CL')})</li>`;
            precioTotal += parseFloat(base.dataset.precio);
        }

        // Proteínas
        document.querySelectorAll('.proteina-input:checked').forEach((item) => {
            resumenLista.innerHTML += `<li class="list-group-item">Proteína: ${item.dataset.nombre} (+$${parseInt(item.dataset.precio).toLocaleString('es-CL')})</li>`;
            precioTotal += parseFloat(item.dataset.precio);
        });

        // Vegetales
        document.querySelectorAll('.vegetal-input:checked').forEach((item) => {
            resumenLista.innerHTML += `<li class="list-group-item">Vegetal: ${item.dataset.nombre} (+$${parseInt(item.dataset.precio).toLocaleString('es-CL')})</li>`;
            precioTotal += parseFloat(item.dataset.precio);
        });

        // Envoltura
        const envoltura = document.querySelector('.envoltura-input:checked');
        if (envoltura) {
            resumenLista.innerHTML += `<li class="list-group-item">Envoltura: ${envoltura.dataset.nombre} (+$${parseInt(envoltura.dataset.precio).toLocaleString('es-CL')})</li>`;
            precioTotal += parseFloat(envoltura.dataset.precio);
        }

        document.getElementById('precio-total').innerText = `Total: $${precioTotal.toLocaleString('es-CL')}`;
        nextTab('confirmar-tab');
    }

    // Limitar máximo 2 proteínas
    document.addEventListener('DOMContentLoaded', function () {
        const maxProteinas = 2;
        const proteinaInputs = document.querySelectorAll('.proteina-input');

        proteinaInputs.forEach(input => {
            input.addEventListener('change', () => {
                const seleccionadas = document.querySelectorAll('.proteina-input:checked').length;

                if (seleccionadas >= maxProteinas) {
                    proteinaInputs.forEach(i => {
                        if (!i.checked) {
                            i.disabled = true;
                        }
                    });
                } else {
                    proteinaInputs.forEach(i => {
                        i.disabled = false;
                    });
                }
            });
        });

        // Limitar máximo 3 vegetales
        const maxVegetales = 3;
        const vegetalInputs = document.querySelectorAll('.vegetal-input');

        vegetalInputs.forEach(input => {
            input.addEventListener('change', () => {
                const seleccionadas = document.querySelectorAll('.vegetal-input:checked').length;

                if (seleccionadas >= maxVegetales) {
                    vegetalInputs.forEach(i => {
                        if (!i.checked) {
                            i.disabled = true;
                        }
                    });
                } else {
                    vegetalInputs.forEach(i => {
                        i.disabled = false;
                    });
                }
            });
        });
    });
</script>

@endpush

@endsection

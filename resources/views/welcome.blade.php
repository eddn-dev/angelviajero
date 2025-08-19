@extends('layouts.app')
@section('title', 'Licencia de Conducir Permanente - AngelViajero')

@section('content')
  <!-- HERO -->
  <header class="relative overflow-hidden bg-gradient-to-b from-white to-slate-50 dark:from-slate-900 dark:to-slate-800 border-b border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-28 text-center">
      <h1 class="mx-auto max-w-4xl text-4xl text-white sm:text-5xl md:text-6xl font-extrabold tracking-tight">
        Obtén tu Licencia de Conducir tipo A
        <span class="block mt-2 bg-gradient-to-r from-orange-500 to-red-600 bg-clip-text text-transparent uppercase tracking-wider">Permanente</span>
      </h1>
      <p class="mt-6 mx-auto max-w-2xl text-base sm:text-lg text-slate-600 dark:text-slate-300">
        Evita filas y trámites complicados. Gestionamos todo por ti en tiempo récord. ¡Contacta ahora y asegura tu lugar!
      </p>
      <div class="mt-8">
        <a href="#"
           class="js-whatsapp-link inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 px-6 py-3 text-white font-semibold shadow-lg shadow-orange-500/20 ring-1 ring-orange-600/30 transition hover:bg-orange-600 hover:-translate-y-0.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-orange-500">
          Iniciar Trámite por WhatsApp
        </a>
      </div>
    </div>
  </header>

  <main>
    <!-- PROCESO -->
    <section id="proceso" class="py-16 lg:py-24">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-center text-3xl sm:text-4xl font-bold tracking-tight">Un Proceso Simple en 3 Pasos</h2>

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          <!-- Card 1 -->
          <article class="rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-sm transition hover:shadow-lg hover:-translate-y-0.5">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-orange-500 text-white">
              <!-- Chat icon -->
              <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M20 2H4C2.9 2 2 2.9 2 4V22L6 18H20C21.1 18 22 17.1 22 16V4C22 2.9 21.1 2 20 2M20 16H5.2L4 17.2V4H20V16Z"/></svg>
            </div>
            <h3 class="text-lg font-semibold">1. Contacto Inicial</h3>
            <p class="mt-2 text-slate-600">Haz clic en el botón de WhatsApp. Un asesor te responderá de inmediato para revisar tu caso.</p>
          </article>

          <!-- Card 2 -->
          <article class="rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-sm transition hover:shadow-lg hover:-translate-y-0.5">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-orange-500 text-white">
              <!-- Docs icon -->
              <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M14 2H6C4.9 2 4 2.9 4 4V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V8L14 2M18 20H6V4H13V9H18V20M8 12H16V14H8V12M8 16H16V18H8V16Z"/></svg>
            </div>
            <h3 class="text-lg font-semibold">2. Envío de Requisitos</h3>
            <p class="mt-2 text-slate-600">Te solicitaremos los documentos básicos. El mismo día que nos mandes tus documentos queda listo el trámite. Necesitarás INE, comprobante de domicilio y CURP.</p>
          </article>

          <!-- Card 3 -->
          <article class="rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-sm transition hover:shadow-lg hover:-translate-y-0.5">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-orange-500 text-white">
              <!-- Check icon -->
              <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.5 2 2 6.5 2 12S6.5 22 12 22 22 17.5 22 12 17.5 2 12 2M10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z"/></svg>
            </div>
            <h3 class="text-lg font-semibold">3. Recoge y Paga al Final</h3>
            <p class="mt-2 text-slate-600">Acude al módulo, recoge tu licencia oficial y, solo hasta tenerla en tus manos, realizas el pago de nuestra gestión.</p>
          </article>
        </div>
      </div>
    </section>

    <!-- REQUISITOS Y COSTOS -->
    <section id="requisitos" class="bg-slate-50 py-16 lg:py-24">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-center text-3xl sm:text-4xl font-bold tracking-tight">Requisitos y Costos Transparentes</h2>

        <div class="mt-10 grid gap-8 lg:grid-cols-2">
          <!-- Requisitos -->
          <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-xl font-semibold">Requisitos Indispensables</h3>
            <p class="mt-2 text-slate-600">Solo necesitamos 6 datos básicos para iniciar tu gestión:</p>

            <ul class="mt-4 space-y-3">
              <li class="flex items-start gap-3">
                <span class="mt-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-orange-500 text-white text-xs">✓</span>
                <span>CURP (Clave Única de Registro de Población).</span>
              </li>
              <li class="flex items-start gap-3">
                <span class="mt-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-orange-500 text-white text-xs">✓</span>
                <span>Correo electrónico vigente.</span>
              </li>
              <li class="flex items-start gap-3">
                <span class="mt-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-orange-500 text-white text-xs">✓</span>
                <span>Número de celular vigente.</span>
              </li>
              <li class="flex items-start gap-3">
                <span class="mt-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-orange-500 text-white text-xs">✓</span>
                <span>Colonia en la que vives.</span>
              </li>
              <li class="flex items-start gap-3">
                <span class="mt-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-orange-500 text-white text-xs">✓</span>
                <span>Código postal.</span>
              </li>
              <li class="flex items-start gap-3">
                <span class="mt-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-orange-500 text-white text-xs">✓</span>
                <span>Una contraseña para crear tu perfil en el portal oficial.</span>
              </li>
            </ul>

            <p class="mt-4 text-sm text-slate-500"><em>*Tu información está 100% segura y solo se usa para este trámite.</em></p>
          </div>

          <!-- Costos -->
          <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm text-center ring-1 ring-red-600/10">
            <h3 class="text-xl font-semibold">Inversión Transparente</h3>
            <p class="mt-2 text-slate-600">Sin costos ocultos. Paga nuestra gestión hasta el final.</p>

            <div class="mt-6 rounded-xl bg-red-50 px-6 py-4 ring-1 ring-red-100">
              <span class="block text-5xl font-extrabold text-red-600 tracking-tight">$400 <span class="text-2xl align-top">MXN</span></span>
              <span class="mt-1 block text-sm text-slate-600">(Nuestros Honorarios de Gestión)</span>
            </div>

            <p class="mt-4 text-sm text-slate-600">
              <strong>Importante:</strong> El costo de los derechos de la licencia <strong>($1,500 MXN)</strong> lo pagas tú directamente al gobierno.
            </p>

            <a href="#"
               class="js-whatsapp-link mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-red-600 px-6 py-3 text-white font-semibold shadow-lg shadow-red-500/20 ring-1 ring-red-700/30 transition hover:bg-red-700 hover:-translate-y-0.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-red-600">
              Pide Informes y Comienza
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="py-16 lg:py-24">
      <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-center text-3xl sm:text-4xl font-bold tracking-tight">Preguntas Frecuentes (FAQ)</h2>

        <div class="mt-10 space-y-4">
          <!-- Item -->
          <details class="group rounded-xl border border-slate-200 bg-white p-4 shadow-sm open:shadow-md transition">
            <summary class="flex cursor-pointer items-center justify-between gap-4">
              <h3 class="text-base sm:text-lg font-semibold">¿La licencia es 100% legal y original?</h3>
              <span class="select-none text-2xl font-bold text-orange-500 transition group-open:rotate-45">+</span>
            </summary>
            <div class="mt-3 text-slate-600">
              Totalmente. El trámite se realiza en los portales oficiales y tú mismo recoges la licencia física en un módulo de gobierno. Es un documento oficial y verificable.
            </div>
          </details>

          <details class="group rounded-xl border border-slate-200 bg-white p-4 shadow-sm open:shadow-md transition">
            <summary class="flex cursor-pointer items-center justify-between gap-4">
              <h3 class="text-base sm:text-lg font-semibold">¿En cuánto tiempo está listo el trámite?</h3>
              <span class="select-none text-2xl font-bold text-orange-500 transition group-open:rotate-45">+</span>
            </summary>
            <div class="mt-3 text-slate-600">
              Una vez que nos proporcionas tus datos, el mismo día queda listo el trámite. ¡Es el servicio más rápido! Las citas de recepción están hábiles en un promedio de 5 días después de finalizar el trámite.
            </div>
          </details>

          <details class="group rounded-xl border border-slate-200 bg-white p-4 shadow-sm open:shadow-md transition">
            <summary class="flex cursor-pointer items-center justify-between gap-4">
              <h3 class="text-base sm:text-lg font-semibold">¿Qué vigencia tiene la licencia?</h3>
              <span class="select-none text-2xl font-bold text-orange-500 transition group-open:rotate-45">+</span>
            </summary>
            <div class="mt-3 text-slate-600">
              La licencia que gestionamos es de tipo A (automóvil particular) y es PERMANENTE. Olvídate de volver a renovarla.
            </div>
          </details>

          <details class="group rounded-xl border border-slate-200 bg-white p-4 shadow-sm open:shadow-md transition">
            <summary class="flex cursor-pointer items-center justify-between gap-4">
              <h3 class="text-base sm:text-lg font-semibold">¿Realmente pago los $400 hasta el final?</h3>
              <span class="select-none text-2xl font-bold text-orange-500 transition group-open:rotate-45">+</span>
            </summary>
            <div class="mt-3 text-slate-600">
              Sí. Es nuestra garantía de satisfacción. Primero te ayudamos a asegurar tu trámite, pasas al módulo, recoges tu licencia y solo entonces nos pagas nuestros honorarios. No arriesgas absolutamente nada.
            </div>
          </details>
        </div>
      </div>
    </section>

    <!-- CTA FINAL -->
    <section class="bg-slate-900 text-white py-16 lg:py-24 text-center">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">¿Listo para conducir sin complicaciones?</h2>
        <p class="mt-4 text-slate-300">Contacta ahora y deja la burocracia en nuestras manos expertas.</p>
        <a href="#"
           class="js-whatsapp-link mt-8 inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 px-6 py-3 text-white font-semibold shadow-lg shadow-orange-500/20 ring-1 ring-orange-600/30 transition hover:bg-orange-600 hover:-translate-y-0.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-orange-400">
          Contactar Asesor Ahora
        </a>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="border-t border-slate-200 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center text-sm text-slate-600">
      &copy; <span id="year">2024</span> AngelViajero - Servicios de Gestión Vehicular.
    </div>
  </footer>

  <!-- WhatsApp Float -->
  <a href="#"
     class="js-whatsapp-link fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-[#25D366] text-white shadow-xl transition hover:scale-110 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#25D366] animate-pulse"
     aria-label="Contactar por WhatsApp" title="Contactar por WhatsApp">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor">
      <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2M12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.29 9.72 20.29 11.92C20.29 16.46 16.58 20.16 12.04 20.16C10.66 20.16 9.31 19.79 8.08 19.08L7.69 18.84L4.39 19.71L5.27 16.5L5.02 16.1C4.23 14.81 3.83 13.36 3.83 11.91C3.83 7.37 7.54 3.67 12.05 3.67M8.53 7.33C8.37 7.33 8.1 7.39 7.87 7.64C7.65 7.89 7.03 8.5 7.03 9.71C7.03 10.93 7.92 12.1 8.03 12.26C8.14 12.41 9.53 14.5 11.66 15.41C12.16 15.61 12.57 15.73 12.89 15.83C13.44 15.98 13.95 15.95 14.36 15.89C14.83 15.82 15.98 15.26 16.19 14.6C16.4 13.95 16.4 13.39 16.34 13.28C16.28 13.17 16.05 13.09 15.83 12.98C15.6 12.87 14.4 12.29 14.18 12.21C13.95 12.12 13.78 12.08 13.62 12.3C13.46 12.52 13 13.03 12.89 13.17C12.78 13.28 12.66 13.3 12.45 13.19C12.23 13.08 11.42 12.83 10.45 11.97C9.72 11.31 9.17 10.5 9.06 10.28C8.95 10.07 9.04 9.96 9.16 9.85C9.27 9.75 9.39 9.59 9.5 9.47C9.61 9.35 9.65 9.19 9.73 9.06C9.81 8.94 9.76 8.78 9.7 8.66C9.64 8.54 9.15 7.33 8.95 7.33H8.53Z"/>
    </svg>
  </a>

@endsection
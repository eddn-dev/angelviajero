<footer class="bg-gray-900 text-gray-400 pt-12 pb-8 mt-16"> <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <div>
                <h3 class="text-xl font-bold text-white mb-4">Angel<span class="text-orange-500">Viajero</span></h3>
                <p class="text-sm">Tu tienda online para encontrar el mejor equipamiento deportivo.</p>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Compra</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{route('tienda.index')}}" class="hover:text-white transition duration-300">Tienda</a></li>
                    <li><a href="{{ route('promociones.index')}}" class="hover:text-white transition duration-300">Ofertas</a></li>
                    <li><a href="{{route('contacto.index')}}" class="hover:text-white transition duration-300">Contacto</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Ayuda</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition duration-300">Preguntas Frecuentes</a></li>
                    <li><a href="#" class="hover:text-white transition duration-300">Envíos y Devoluciones</a></li>
                    <li><a href="{{route('contacto.index')}}" class="hover:text-white transition duration-300">Contacto</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">Síguenos</h4>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.294h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.323-1.325z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-.422.724-.665 1.56-.665 2.454 0 1.717.87 3.228 2.21 4.111-.806-.026-1.566-.247-2.229-.616v.054c0 2.39 1.7 4.381 3.951 4.84-.414.111-.849.171-1.296.171-.316 0-.623-.031-.922-.086.63 1.952 2.445 3.377 4.604 3.417-1.688 1.32-3.811 2.104-6.122 2.104-.398 0-.79-.023-1.175-.068 2.189 1.407 4.79 2.229 7.557 2.229 9.054 0 13.999-7.502 13.999-13.986 0-.213-.005-.425-.014-.637.961-.695 1.798-1.56 2.461-2.548z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700 pt-8 text-center text-sm">
            <p>&copy; 2025 AngelViajero. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
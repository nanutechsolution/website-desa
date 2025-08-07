  @props(['href' => '#'])
  <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
      <h3 class="text-2xl font-bold text-accent-dark dark:text-soft-gray mb-4 sm:mb-0">Daftar Slider</h3>
      <a href="{{ route('admin.hero-sliders.create') }}"
          class="inline-flex items-center justify-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-soft-gray uppercase tracking-widest hover:bg-primary-darker active:bg-primary-dark focus:outline-none focus:border-primary-darker focus:ring ring-primary-light disabled:opacity-25 transition ease-in-out duration-150 w-full sm:w-auto">
          <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          {{ $slot }}
      </a>
  </div>

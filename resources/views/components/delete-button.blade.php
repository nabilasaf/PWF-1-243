<form action="{{ $url }}" method="POST"
      onsubmit="return confirm('Yakin mau hapus data ini?')">
    @csrf
    @method('DELETE')

    <button type="submit"
        class="inline-flex items-center gap-2 px-4 py-2 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white text-sm font-medium rounded-lg transition duration-150">
        
        🗑️ Delete
    </button>
</form>
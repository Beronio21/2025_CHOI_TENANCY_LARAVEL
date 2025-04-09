<div id="failureModal" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-lg font-semibold mb-4">Error</h2>
        <p>{{ $message }}</p>
        <button onclick="closeModal('failureModal')" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Close</button>
    </div>
</div>
<script>
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }
</script> 
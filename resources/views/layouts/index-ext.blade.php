<!-- Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Are you sure you want to delete this task?</p>
        <div class="modal-buttons">
            <button class="btn-modal btn-cancel">Cancel</button>
            <button class="btn-modal btn-confirm">Delete</button>
        </div>
    </div>
</div>

<form id="deleteForm" action="" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('deleteModal');
        const closeModal = document.querySelector('.close');
        const cancelBtn = document.querySelector('.btn-cancel');
        const confirmBtn = document.querySelector('.btn-confirm');
        let deleteForm = document.getElementById('deleteForm');

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const taskId = this.getAttribute('data-task-id');
                deleteForm.action = `/tasks/${taskId}`;
                modal.style.display = 'block';
            });
        });

        closeModal.onclick = function () {
            modal.style.display = 'none';
        }

        cancelBtn.onclick = function () {
            modal.style.display = 'none';
        }

        confirmBtn.onclick = function () {
            deleteForm.submit();
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    });

    function applyFilter(status) {
        const url = new URL(window.location.href);
        const searchParams = new URLSearchParams(url.search);
        searchParams.set('status', status);
        window.location.href = `${url.origin}${url.pathname}?${searchParams.toString()}`;
    }
</script>

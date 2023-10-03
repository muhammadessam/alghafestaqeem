<form action="{{route('admin.evaluation-transactions.destroy', ['evaluation_transaction'=>$id])}}" method="post" onsubmit="return confirm('Are you sure? All data will be delete?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="pg-btn-white text-danger dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700">
        <i class="fa fa-trash"></i>
    </button>
</form>

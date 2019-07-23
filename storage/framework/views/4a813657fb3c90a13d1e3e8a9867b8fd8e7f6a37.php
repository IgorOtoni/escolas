<?php /* C:\xampp\htdocs\adm_eglise\vendor\maddhatter\laravel-fullcalendar\src\views\script.blade.php */ ?>
<script>
    $(document).ready(function(){
        $('#calendar-<?php echo e($id); ?>').fullCalendar(<?php echo $options; ?>);
    });
</script>

<html>

<head></head>
<body>
<p>
    @json($array)
</p>

<p>
    var app = <?php echo json_encode($array); ?>;
</p>

<script>
    var app =@json($array);
    console.log(app);
</script>


<script>
    var app2 = <?php echo json_encode($array); ?>;
    console.log(app2);
</script>

</body>
</html>
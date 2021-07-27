<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <title>Evenement lijst PDF</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Nummer</th>
        <th scope="col">Naam</th>
        <th scope="col">Email</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($rows as $item)
      <tr>
        <td>{{$item["id"]}}</td>
        <td>{{$item["name"]}}</td>
        <td>{{$item["email"]}}</td>
      </tr>  
   @endforeach
    
    </tbody>
  </table>
  </div>
</body>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clone Trello</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</head>

<body>

  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <span class="navbar-text">
      <h1 class="text-middle">Task List</h1>
    </span>
    <h1 style="float: right; color: white;"> Here user name : {{ auth()->user()->name }}</h1>
  </nav>

    @if(session('message'))
        <div class="alert alert-success"><b>Well done ! </b> {{ session('message') }}.</div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger"><b>Danger ! </b> {{ session('error') }}.</div>
    @endif

  <form action="/add-task" method="post">
  @csrf
    <div class="row">
        <div class="form-group my-width">
        <label for="type-tache">Select Task Type</label>
        <select class="form-control" id="type-tache" name="task_type">
            <option value="">---select task type---</option>
            <option value="To Do">Task to do</option>
            <option value="On Going">On going task</option>
            <option value="On Testing">Task on testing</option>
            <option value="Done">Task done</option>
        </select>
        </div>
    </div>

    <div class="row">
        <div class="form-group my-width">
        <label for="tache-nom">Task Name</label>
        <input type="text" class="form-control" name="task_name" id="tache-nom">
        </div>
    </div>

    <div class="row">
        <div class="form-group my-width">
        <label for="description-tache">Task description</label>
        <textarea class="form-control" name="task_description" rows="3" id="description-tache"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="form-group my-width">
        <label for="description-tache">Fichiers</label>
        <input type="file" id="type-file">
        </div>
    </div>

    <div class="row" id="div-add">
        <button type="submit" class="btn btn-primary my-btn" id="button-add">ADD</button>
    </div>
  </form>

  <div class="row liste-taches">
    <div class="col-3">
      <div class="container">
        <div class="row">
          <h3 class="statut">Task To Do</h3>
          <input type="color" class="couleur" id="color-picker-to-do" onchange="changecolor1()">
        </div>
        <ol class="list-group" id="do-list">
        @foreach ($tasks as $task)
            @if($task->task_type == "To Do")
                <li class="list-group-item liste-to-do">  {{ $task->task_name }} <i class="fa fa-trash text-danger cursor-pointer"></i> <i class="fas fa-long-arrow-alt-right text-primary cursor-pointer"></i> <i class="fas fa-pencil-alt text-warning cursor-pointer" ></i> <i class="far fa-eye text-success cursor-pointer" data-toggle="modal" data-target="#myModal" ></i> </li>
            @endif
		@endforeach
        </ol>
      </div>
    </div>

    <div class="col-3">
      <div class="container">
        <div class="row">
          <h3 class="statut">On going Task</h3>
          <input type="color" class="couleur" id="color-picker-on-going" onclick="changecolor2()">
        </div>
        <ol class="list-group" id="on-going-list">
        @foreach ($tasks as $task)
            @if($task->task_type == "On Going")
                <li class="list-group-item liste-to-do">  {{ $task->task_name }} <i class="fa fa-trash text-danger cursor-pointer"></i> <i class="fas fa-long-arrow-alt-right text-primary cursor-pointer"></i> <i class="fas fa-pencil-alt text-warning cursor-pointer" ></i> <i class="far fa-eye text-success cursor-pointer" data-toggle="modal" data-target="#myModal" ></i> </li>
            @endif
		@endforeach
        </ol>
      </div>
    </div>

    <div class="col-3">
      <div class="container">
        <div class="row">
          <h3 class="statut">Task Testing</h3>
          <input type="color" class="couleur" id="color-picker-on-testing" onclick="changecolor3()">
        </div>
        <ol class="list-group" id="testing-list">
        @foreach ($tasks as $task)
            @if($task->task_type == "On Testing")
                <li class="list-group-item liste-to-do">  {{ $task->task_name }} <i class="fa fa-trash text-danger cursor-pointer"></i> <i class="fas fa-long-arrow-alt-right text-primary cursor-pointer"></i> <i class="fas fa-pencil-alt text-warning cursor-pointer" ></i> <i class="far fa-eye text-success cursor-pointer" data-toggle="modal" data-target="#myModal" ></i> </li>
            @endif
		@endforeach
        </ol>
      </div>
    </div>

    <div class="col-3">
      <div class="container">
        <div class="row">
          <h3 class="statut">Task Done</h3>
          <input type="color" class="couleur" id="color-picker-done" onclick="changecolor4()">
        </div>
        <ol class="list-group" id="done-list">
        @foreach ($tasks as $task)
            @if($task->task_type == "Done")
                <li class="list-group-item liste-to-do">  {{ $task->task_name }} <i class="fa fa-trash text-danger cursor-pointer"></i> <i class="fas fa-long-arrow-alt-right text-primary cursor-pointer"></i> <i class="fas fa-pencil-alt text-warning cursor-pointer" ></i> <i class="far fa-eye text-success cursor-pointer" data-toggle="modal" data-target="#myModal" ></i> </li>
            @endif
		@endforeach
        </ol>
      </div>
    </div>
  </div>

  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Task Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <p><b>Type de la tache :</b> <label id="type-de-la-tache"> </label></p>
          <p><b>Nom de la tache :</b> <label id="nom-de-la-tache"> </label></p>
          <p><b>Description de la tache :</b> <label id="description-de-la-tache"> </label></p>
          <P><b> Votre image </b></P>
          <div class="image-de-la-modale" id="choosed-image"> </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="close()">Close</button>
        </div>

      </div>
    </div>
  </div>

  <script>
    var tabTaches = [];

    function displayTask() {
      var ToDoList = document.getElementById("do-list");
      var OnGoingTaskList = document.getElementById("on-going-list");
      var TaskTestingList = document.getElementById("testing-list");
      var TaskDoneList = document.getElementById("done-list");

      ToDoList.innerHTML = "";
      OnGoingTaskList.innerHTML = "";
      TaskTestingList.innerHTML = "";
      TaskDoneList.innerHTML = "";

      for (let i = 0; i < tabTaches.length; i++) {
        var eltToDo = '<li class="list-group-item liste-to-do"> ' + tabTaches[i].nom + ' <i class="fa fa-trash text-danger cursor-pointer" onclick = "deleteTask(' + i + ')"></i> <i class="fas fa-long-arrow-alt-right text-primary cursor-pointer" onclick = "arrowright(' + i + ')"></i> <i class="fas fa-pencil-alt text-warning cursor-pointer" onclick = "fillForm(' + i + ')"></i> <i class="far fa-eye text-success cursor-pointer" data-toggle="modal" data-target="#myModal" onclick = "show(' + i + ')"></i> </li>';
        var eltOnGoing = '<li class="list-group-item liste-on-going"> ' + tabTaches[i].nom + ' <i class="fa fa-trash text-danger cursor-pointer" onclick = "deleteTask(' + i + ')"></i> <i class="fas fa-long-arrow-alt-right text-primary cursor-pointer" onclick = "arrowright(' + i + ')"></i> <i class="fas fa-pencil-alt text-warning cursor-pointer" onclick = "fillForm(' + i + ')"></i> <i class="far fa-eye text-success cursor-pointer" data-toggle="modal" data-target="#myModal" onclick = "show(' + i + ')"></i> </li>';
        var eltOnTesting = '<li class="list-group-item liste-on-testing"> ' + tabTaches[i].nom + ' <i class="fa fa-trash text-danger cursor-pointer" onclick = "deleteTask(' + i + ')"></i> <i class="fas fa-long-arrow-alt-right text-primary cursor-pointer" onclick = "arrowright(' + i + ')"></i> <i class="fas fa-pencil-alt text-warning cursor-pointer" onclick = "fillForm(' + i + ')"></i> <i class="far fa-eye text-success cursor-pointer" data-toggle="modal" data-target="#myModal" onclick = "show(' + i + ')"></i> </li>';
        var eltDone = '<li class="list-group-item liste-done"> ' + tabTaches[i].nom + ' <i class="fa fa-trash text-danger cursor-pointer" onclick = "deleteTask(' + i + ')"></i> <i class="fas fa-pencil-alt text-warning cursor-pointer" onclick = "fillForm(' + i + ')"></i> <i class="far fa-eye text-success cursor-pointer" data-toggle="modal" data-target="#myModal" onclick = "show(' + i + ')"></i> </li>';

        if (tabTaches[i].type == "To Do") {
          ToDoList.innerHTML += eltToDo;
          changecolor1(event);
        }

        if (tabTaches[i].type == "On Going") {
          OnGoingTaskList.innerHTML += eltOnGoing;
          changecolor2(event);
        }

        if (tabTaches[i].type == "On Testing") {
          TaskTestingList.innerHTML += eltOnTesting;
          changecolor3(event);
        }

        if (tabTaches[i].type == "Done") {
          TaskDoneList.innerHTML += eltDone;
          changecolor4(event);
        }
      }

    }

    function add() {

      var TypeTache = document.getElementById("type-tache").value;
      var TacheNom = document.getElementById("tache-nom").value;
      var DescriptionTache = document.getElementById("description-tache").value;
      var FichiersImageInput = document.getElementById("type-file").value;
      var bool = false;
      var message = "Veuillez entrer";

      if (TypeTache == "") {
        message = message + " le type de la tache";
        bool = true;
      }

      if (TacheNom == "") {
        message = message + " le nom de la tache";
        bool = true;
      }

      if (DescriptionTache == "") {
        message = message + " la description";
        bool = true;
      }
      if (FichiersImageInput == "") {
        message = message + " un fichier image";
        bool = true;
      }

      if (bool) {
        alert(message);
      } else {
        var FichiersImage = document.getElementById("type-file").files[0].name;
        var tache = { id: 1, type: TypeTache, nom: TacheNom, description: DescriptionTache, image: FichiersImage };
        tabTaches.push(tache);

        document.getElementById("type-tache").value = "";
        document.getElementById("tache-nom").value = "";
        document.getElementById("description-tache").value = "";
        document.getElementById("type-file").value = "";

      }

      displayTask();
    }


    function show(i) {

      var lb1 = document.getElementById("type-de-la-tache");
      var lb2 = document.getElementById("nom-de-la-tache");
      var lb3 = document.getElementById("description-de-la-tache");
      var lb4 = document.getElementById("choosed-image");
      
      
      
      while (lb1.hasChildNodes()) {
        lb1.removeChild(lb1.firstChild);
      }
      while (lb2.hasChildNodes()) {
        lb2.removeChild(lb2.firstChild);
      }
      while (lb3.hasChildNodes()) {
        lb3.removeChild(lb3.firstChild);
      }
      lb4.innerHTML = "";

      var currentTask = tabTaches[i];

      var els1 = document.createTextNode(currentTask.type);
      var els2 = document.createTextNode(currentTask.nom);
      var els3 = document.createTextNode(currentTask.description);
      var img = '<img src="'+ currentTask.image + '" id="picture">';

      lb1.appendChild(els1);
      lb2.appendChild(els2);
      lb3.appendChild(els3);
      lb4.innerHTML += img;

    }


    function deleteTask(i) {
      tabTaches.splice(i, 1);
      displayTask();
    }

    function arrowright(i) {

      if (tabTaches[i].type == "To Do") {
        tabTaches[i].type = "On Going";
      } else if (tabTaches[i].type == "On Going") {
        tabTaches[i].type = "On Testing";
      } else if (tabTaches[i].type == "On Testing") {
        tabTaches[i].type = "Done";
      }

      displayTask();

    }
    function fillForm(i) {

      var TypeTache = document.getElementById("type-tache");
      var TacheNom = document.getElementById("tache-nom");
      var DescriptionTache = document.getElementById("description-tache");

      TypeTache.value = tabTaches[i].type;
      TacheNom.value = tabTaches[i].nom;
      DescriptionTache.value = tabTaches[i].description;

      var divButton = document.getElementById("div-add");
      var subtitute = '<button type="button" class="btn btn-success my-btn" id ="button-edit" onclick="edit(' + i + ')">Edit</button>';
      var cancel = '<button type="button" class="btn btn-danger my-btn" id ="button-cancel" onclick="cancel(' + i + ')">Cancel</button>';

      divButton.innerHTML = "";
      divButton.innerHTML += subtitute;
      divButton.innerHTML += cancel;
      document.getElementById("type-file").value = "";
    }

    function edit(i) {

      var TypeTache = document.getElementById("type-tache").value;
      var TacheNom = document.getElementById("tache-nom").value;
      var DescriptionTache = document.getElementById("description-tache").value;
      var FichiersImageInput = document.getElementById("type-file").value;

      var bool = false;
      var message = "Veuillez entrer";

      if (TypeTache == "") {
        message = message + " le type de la tache";
        bool = true;
      }

      if (TacheNom == "") {
        message = message + " le nom de la tache";
        bool = true;
      }

      if (DescriptionTache == "") {
        message = message + " la description";
        bool = true;
      }
      if (FichiersImageInput == "") {
        message = message + " un fichier image";
        bool = true;
      }

      if (bool) {
        alert(message);
      } else {
        var divButton = document.getElementById("div-add");
        var addButton = '<button type="button" class="btn btn-primary my-btn" id ="div-add" onclick="add()">ADD</button>';
        var FichiersImage = document.getElementById("type-file").files[0].name;
        tabTaches[i].type = TypeTache;
        tabTaches[i].nom = TacheNom;
        tabTaches[i].description = DescriptionTache;
        tabTaches[i].image = FichiersImage;
        divButton.innerHTML = "";
        divButton.innerHTML += addButton;
        document.getElementById("type-tache").value = "";
        document.getElementById("tache-nom").value = "";
        document.getElementById("description-tache").value = "";
        document.getElementById("type-file").value = "";
      }

      displayTask();
    }
    function cancel() {

      var TypeTache = document.getElementById("type-tache");
      var TacheNom = document.getElementById("tache-nom");
      var DescriptionTache = document.getElementById("description-tache");
      var divButton = document.getElementById("div-add");
      var addButton = '<button type="button" class="btn btn-primary my-btn" id ="button-add" onclick="add()">ADD</button>';
      TypeTache.value = "";
      TacheNom.value = "";
      DescriptionTache.value = "";
      document.getElementById("type-file").value = "";
      divButton.innerHTML = "";
      divButton.innerHTML += addButton;
    }

    function changecolor1(event) {

      var change1 = document.getElementsByClassName("liste-to-do");

      let couleur = document.getElementById("color-picker-to-do").value;
      for (let i = 0; i < change1.length; i++) {
        change1[i].style.borderColor = couleur;
      }
    }
    function changecolor2(event) {

      var change2 = document.getElementsByClassName("liste-on-going");

      let couleur = document.getElementById("color-picker-on-going").value;
      for (let i = 0; i < change2.length; i++) {
        change2[i].style.borderColor = couleur;
      }
    }
    function changecolor3(event) {

      var change3 = document.getElementsByClassName("liste-on-testing");

      let couleur = document.getElementById("color-picker-on-testing").value;
      for (let i = 0; i < change3.length; i++) {
        change3[i].style.borderColor = couleur;
      }
    }
    function changecolor4(event) {

      var change4 = document.getElementsByClassName("liste-done");

      let couleur = document.getElementById("color-picker-done").value;
      for (let i = 0; i < change4.length; i++) {
        change4[i].style.borderColor = couleur;
      }
    }

  </script>

</body>

</html>
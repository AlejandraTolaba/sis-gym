<a href="{{ route('students.show',$id) }}"><button name="show-dates" title="Ver datos de alumno" type="submit" class="btn btn-success btn-sm"><i class="fa fa-user"></i> Visualizar</button></a>
<a href="{{ route('students.edit',$id) }}"><button name="edit" title="Editar alumno" type="submit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button></a>
<a href="{{route('inscriptions',$id)}}"><button name="index" type="submit" title="Ver inscripciones" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Inscripciones</button></a>
<a href="{{ route('bodychecks',$id) }}"><button name="show" title="Ver fichas de control corporal" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Fichas de control</button></a>
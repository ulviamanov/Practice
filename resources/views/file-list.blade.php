

 <table class="table" id="all-log" >

       <thead>
             <tr>
                 <th> Name</th>
                 <th> Size (in kb)</th>
                 <th> Mime type</th>  
             </tr>
       </thead>
             <tbody>
                @foreach ($allFile as $file)
                <tr>
                    <td>{{ $file->name }} </td>
                    <td>{{ $file->size }} </td>
                    <td>{{ $file->mime_type }} </td>
                </tr>
                 @endforeach
    
      </tbody>
 </table>
 
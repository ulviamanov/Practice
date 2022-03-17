

 <table class="table" id="basecone-log" >
     <h3 >Total Record Found - <strong id="totalRecords"></strong></h3>
       <thead>
             <tr>
                 <th> Name</th>
                 <th> City</th>
                 <th> Country</th>
                 <th> Project</th>
                 <th> Budget</th>
                
                 
             </tr>
       </thead>
             <tbody>
                @foreach ($allCompany as $company)
                <tr>
                    <td>{{ $company->name }} </td>
                    <td>{{ $company->city }} </td>
                    <td>{{ $company->country }} </td>
                    <td>{{ $company->project_name }} </td>
                    <td>{{ $company->budget }} </td>
                </tr>
                 @endforeach
    
      </tbody>
 </table>
 
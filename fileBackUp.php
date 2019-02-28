<?php

if( $request->has('submit-doc')) 
        {
            $this->validate($request, [
                'title' => 'required',
                'document' => 'required',
            ]);

            $document = $request->file('document');

             //get filename with extension
             //$photo = $request->file('photo');
             $file_name_with_ext = $request->file('document')->getClientOriginalName(); 
             //get filename only
             $filename = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
             //get extension only
             $ext = $document->getClientOriginalExtension();
             //File to store
             $filename = preg_replace('/[^A-Za-z0-9]/', '', $filename);
             $filename= substr($filename, 0, 10);
             $salt = substr(str_shuffle(md5(rand(1, 100))), 0, 5);
             $file_name_to_store = 'document_'.$filename.'_'.time().'_'.$salt.'.'.$ext;
    
             //Upload to server
             //$path = $document->storeAs(public_path('/kmdp_2/repo/'), $file_name_to_store);
             //Upload to server
            // $path = public_path('/kmdp_2/repo/');
             $document->move(public_path('/kmdp_2/repo/'), $file_name_to_store);


             //$document->save($path.'/'.$file_name_to_store);
         
                DB::table('event_files')
                    ->insert([
                        'event_id' => $request->input('event'),
                        'document' => $file_name_to_store,
                        'doc_caption' => $request->input('title'),
                    ]);

            return redirect("/events/$id/edit")->with('success', 'Document Uploaded');
        }
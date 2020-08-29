# Web File Explorer
***
**WebFE - A php based file explorer** 
***
The Web File Explorer provides a nice preview of the html files in a directory and it's subdirectories.  
![Screenshot](https://github.com/JithinPavithran/web-file-explorer/blob/master/2020-08-29_07-29.png)  
The Web File Explorer was first designed to provide a nice view for the exported notes from joplin.
However, this uitilty can also be used for other generic purposes as well.

# How to use WebFE with Joplin?
1. Open Joplin and select a notebook that you like to export.
2. Export the note by going to "File --> Export --> HTML - HTML Directory".
3. Choose a location of your choice and export the notes.
4. Download and extract the WebFE files in your notes folder (where you exported your notes).
5. Your folder structure should look like the following:
```
Notebook Folder
  |
  |---- Sub notebook folder 1
  |        |---- Note 11
  |        \---- Note 12
  |---- Sub notebook folder 2
  |---- Note 1
  |---- Note 2
  |---- index.php  (from web-file-explorer)
  \---- start.sh   (from web-file-explorer)
```
6. Start the web server by running `bash start.sh`
7. Your notes will be available at http://localhost:8080/

**DISCLAIMER:** WebFE utility is provided only for local usage only. It is highly recommended not to expose your notes to public using WebFE.

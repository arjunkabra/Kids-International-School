<?php

function dashboardPagination($offset,$limit,$numrows) {
	
	if ($offset>=5) {
    $prevoffset=$offset-5;
    print "<a class=\"overflow overflowPrev\" href=\"main?offset=$prevoffset\">Prev</a>";
    }

    $pages=intval($numrows/$limit);

    if ($numrows%$limit) {
    $pages++;
    }

    if (!(($offset/$limit)>=$pages) && $pages!=1) {
    $newoffset=$offset+$limit;
    print "<a class=\"overflow overflowNext\"  href=\"main?offset=$newoffset\">Next</a>";
    }
	
}

function clPagination($offset,$limit,$numrows) {
	
	if ($offset>=10) {
    $prevoffset=$offset-10;
    print "<a class=\"overflow overflowPrev\" href=\"contactedList?offset=$prevoffset\">Prev</a>";
    }

    $pages=intval($numrows/$limit);

    if ($numrows%$limit) {
    $pages++;
    }

    if (!(($offset/$limit)>=$pages) && $pages!=1) {
    $newoffset=$offset+$limit;
    print "<a class=\"overflow overflowNext\"  href=\"contactedList?offset=$newoffset\">Next</a>";
    }
	
}

function smPagination($offset,$limit,$numrows) {
	
	if ($offset>=10) {
    $prevoffset=$offset-10;
    print "<a class=\"overflow overflowPrev\" href=\"sentMails?offset=$prevoffset\">Prev</a>";
    }

    $pages=intval($numrows/$limit);

    if ($numrows%$limit) {
    $pages++;
    }

    if (!(($offset/$limit)>=$pages) && $pages!=1) {
    $newoffset=$offset+$limit;
    print "<a class=\"overflow overflowNext\"  href=\"sentMails?offset=$newoffset\">Next</a>";
    }
	
}

function trashPagination($offset,$limit,$numrows) {
	
	if ($offset>=10) {
    $prevoffset=$offset-10;
    print "<a class=\"overflow overflowPrev\" href=\"trash?offset=$prevoffset\">Prev</a>";
    }

    $pages=intval($numrows/$limit);

    if ($numrows%$limit) {
    $pages++;
    }

    if (!(($offset/$limit)>=$pages) && $pages!=1) {
    $newoffset=$offset+$limit;
    print "<a class=\"overflow overflowNext\"  href=\"trash?offset=$newoffset\">Next</a>";
    }
	
}

function viewAdminsPagination($offset,$limit,$numrows) {
	
	if ($offset>=5) {
    $prevoffset=$offset-5;
    print "<a class=\"overflow overflowPrev\" href=\"viewAdmins?offset=$prevoffset\">Prev</a>";
    }

    $pages=intval($numrows/$limit);

    if ($numrows%$limit) {
    $pages++;
    }

    if (!(($offset/$limit)>=$pages) && $pages!=1) {
    $newoffset=$offset+$limit;
    print "<a class=\"overflow overflowNext\"  href=\"viewAdmins?offset=$newoffset\">Next</a>";
    }
	
}

function addStudentsPagination($offset,$limit,$numrows) {
	
	if ($offset>=50) {
    $prevoffset=$offset-50;
    print "<a class=\"overflow overflowPrev\" href=\"addStudents?offset=$prevoffset\">Prev</a>";
    }

    $pages=intval($numrows/$limit);

    if ($numrows%$limit) {
    $pages++;
    }

    if (!(($offset/$limit)>=$pages) && $pages!=1) {
    $newoffset=$offset+$limit;
    print "<a class=\"overflow overflowNext\"  href=\"addStudents?offset=$newoffset\">Next</a>";
    }
	
}

?>

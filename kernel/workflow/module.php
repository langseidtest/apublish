<?php
//
// Created on: <17-Apr-2002 11:05:08 amos>
//
// Copyright (C) 1999-2002 eZ systems as. All rights reserved.
//
// This source file is part of the eZ publish (tm) Open Source Content
// Management System.
//
// This file may be distributed and/or modified under the terms of the
// "GNU General Public License" version 2 as published by the Free
// Software Foundation and appearing in the file LICENSE.GPL included in
// the packaging of this file.
//
// Licencees holding valid "eZ publish professional licences" may use this
// file in accordance with the "eZ publish professional licence" Agreement
// provided with the Software.
//
// This file is provided AS IS with NO WARRANTY OF ANY KIND, INCLUDING
// THE WARRANTY OF DESIGN, MERCHANTABILITY AND FITNESS FOR A PARTICULAR
// PURPOSE.
//
// The "eZ publish professional licence" is available at
// http://ez.no/home/licences/professional/. For pricing of this licence
// please contact us via e-mail to licence@ez.no. Further contact
// information is available at http://ez.no/home/contact/.
//
// The "GNU General Public License" (GPL) is available at
// http://www.gnu.org/copyleft/gpl.html.
//
// Contact licence@ez.no if any conditions of this licencing isn't clear to
// you.
//

$Module = array( "name" => "eZWorkflow" );

$ViewList = array();
$ViewList["edit"] = array(
    "script" => "edit.php",
    "params" => array( "WorkflowID" ) );
$ViewList["groupedit"] = array(
    "script" => "groupedit.php",
    "params" => array( "WorkflowGroupID" ) );
$ViewList["down"] = array(
    "script" => "edit.php",
    "params" => array( "WorkflowID", "EventID" ) );
$ViewList["up"] = array(
    "script" => "edit.php",
    "params" => array( "WorkflowID", "EventID" ) );
$ViewList["list"] = array(
    "script" => "list.php",
    "params" => array() );
$ViewList["grouplist"] = array(
    "script" => "grouplist.php",
    "params" => array() );
$ViewList["process"] = array(
    "script" => "process.php",
    "params" => array( "WorkflowProcessID" ) );
$ViewList["run"] = array(
    "script" => "run.php",
    "params" => array( "WorkflowProcessID" ) );
$ViewList["event"] = array(
    "script" => "event.php",
    "params" => array( "WorkflowID", "EventID" ) );

$FeatureArray = array();
$FeatureArray["workflow"] = array( "type" => "class",
                                   "classname" => "eZWorkflowFeature" );
$FeatureArray["workflow_event"] = array( "type" => "class",
                                         "classname" => "eZWorkflowEventFeature" );

?>

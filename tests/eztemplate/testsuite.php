<?php
//
// Definition of eZTemplate test suite
//
// Created on: <30-Jan-2004 11:53:06 >
//
// Copyright (C) 1999-2004 eZ systems as. All rights reserved.
//
// This source file is part of the eZ publish (tm) Open Source Content
// Management System.
//
// This file may be distributed and/or modified under the terms of the
// "GNU General Public License" version 2 as published by the Free
// Software Foundation and appearing in the file LICENSE included in
// the packaging of this file.
//
// Licencees holding a valid "eZ publish professional licence" version 2
// may use this file in accordance with the "eZ publish professional licence"
// version 2 Agreement provided with the Software.
//
// This file is provided AS IS with NO WARRANTY OF ANY KIND, INCLUDING
// THE WARRANTY OF DESIGN, MERCHANTABILITY AND FITNESS FOR A PARTICULAR
// PURPOSE.
//
// The "eZ publish professional licence" version 2 is available at
// http://ez.no/ez_publish/licences/professional/ and in the file
// PROFESSIONAL_LICENCE included in the packaging of this file.
// For pricing of this licence please contact us via e-mail to licence@ez.no.
// Further contact information is available at http://ez.no/company/contact/.
//
// The "GNU General Public License" (GPL) is available at
// http://www.gnu.org/copyleft/gpl.html.
//
// Contact licence@ez.no if any conditions of this licencing isn't clear to
// you.
//

$SuiteDefinition = array( 'name' => 'eZTemplate',
                          'tests' => array() );

$SuiteDefinition['tests'][] = array( 'name' => 'OutputHandling',
                                     'file' => 'eztesttemplateoutput.php',
                                     'class' => 'eZTestTemplateOutput' );

$SuiteDefinition['tests'][] = array( 'name' => 'Operator',
                                     'file' => 'eztesttemplateoperator.php',
                                     'class' => 'eZTestTemplateOperator' );

$SuiteDefinition['tests'][] = array( 'name' => 'ProcessedOperator',
                                     'file' => 'eztestprocessedtemplateoperator.php',
                                     'class' => 'eZTestProcessedTemplateOperator' );

$SuiteDefinition['tests'][] = array( 'name' => 'Function',
                                     'file' => 'eztesttemplatefunction.php',
                                     'class' => 'eZTestTemplateFunction' );

$SuiteDefinition['tests'][] = array( 'name' => 'ProcessedFunction',
                                     'file' => 'eztestprocessedtemplatefunction.php',
                                     'class' => 'eZTestProcessedTemplateFunction' );

?>

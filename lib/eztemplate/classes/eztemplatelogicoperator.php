<?php
//
// Definition of eZTemplateLogicOperator class
//
// Created on: <18-Apr-2002 12:15:07 amos>
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

/*!
  \class eZTemplateLogicOperator eztemplatelogicoperator.php
  \ingroup eZTemplateOperators
  \brief Logical operators for creating and manipulating booleans

  This class adds powerful template handling by enabling logical operators
  which alter the output of templates from input values.

  How counts are interpreted:
  -# If the data is an array the array count is used
  -# If the data is an object the object attribute count is used
  -# If the data is a numeric the value is used
  -# If the data is a boolean false is 0 and true is 1
  -# For all other data 0 is used

  Data is considered null(or false) if the data count is 0(see above) or
  the data is really null (is_null). Data is considered true if it is not null.

  The supported operators are:
  - lt\n
    Returns true if the input count is less than the parameter data count. See how
    count is interpreted above.
  - le\n
    Same as lt but use less than or equal to.
  - gt\n
    Same as lt but returns true for input greater than data.
  - ge\n
    Same as gt but use greater than or equal to.
  - eq\n
    Returns true if all the input parameters match. Matching is casual meaning
    that an integer of value 0 will match a boolean of type false.
  - null\n
    Returns true if the data is null, false otherwise
  - true
  - false\n
    Creates a true/false boolean
  - or\n
    Evaluates all parameter values until one is found to be true(see above), then
    returns that value. The remaining parameters are not evaluated at all.
    If there are no parameter or all elements were false it returns false.
  - and\n
    Evaluates all parameter values until one is found to be false(see above), then
    returns that false. The remaining parameters are not evaluated at all.
    If there are no parameter it returns false, if no elements were false it returns the last parameter value.
  - choose\n
    Uses the input count to pick one of the parameter elements. The input count equals
    the parameter index.

*/

class eZTemplateLogicOperator
{
    /*!
     Initializes the operator class with the various operator names.
    */
    function eZTemplateLogicOperator( /*! The name for the "less than" operator */
                                      $lt_name = "lt",
                                      /*! The name for the "greater than" operator */
                                      $gt_name = "gt",
                                      /*! The name for the "less than or equal" operator */
                                      $le_name = "le",
                                      /*! The name for the "greater than or equal" operator */
                                      $ge_name = "ge",
                                      /*! The name for the "equal" operator */
                                      $eq_name = "eq",
                                      /*! The name for the "is null" operator */
                                      $null_name = "null",
                                      /*! The name for the "not" operator */
                                      $not_name = "not",
                                      /*! The name for the "create true boolean" operator */
                                      $true_name = "true",
                                      /*! The name for the "create false boolean" operator */
                                      $false_name = "false",
                                      /*! The name for the "logical or" operator */
                                      $or_name = "or",
                                      /*! The name for the "logical and" operator */
                                      $and_name = "and",
                                      /*! The name for the "choose" operator */
                                      $choose_name = "choose" )
    {
        $this->Operators = array( $lt_name, $gt_name, $le_name, $ge_name, $eq_name,
                                  $null_name, $not_name,
                                  $or_name, $and_name,
                                  $true_name, $false_name, $choose_name );
        $this->LTName = $lt_name;
        $this->GTName = $gt_name;
        $this->LEName = $le_name;
        $this->GEName = $ge_name;
        $this->EQName = $eq_name;
        $this->NullName = $null_name;
        $this->OrName = $or_name;
        $this->AndName = $and_name;
        $this->NotName = $not_name;
        $this->TrueName = $true_name;
        $this->FalseName = $false_name;
        $this->ChooseName = $choose_name;
    }

    /*!
     Returns the operators in this class.
    */
    function &operatorList()
    {
        return $this->Operators;
    }

    /*!
     \return true to tell the template engine that the parameter list exists per operator type.
    */
    function namedParameterPerOperator()
    {
        return true;
    }

    /*!
     See eZTemplateOperator::namedParameterList
    */
    function namedParameterList()
    {
        return array( $this->LTName => array( "threshold" => array( "type" => "mixed",
                                                                    "required" => true,
                                                                    "default" => false ) ),
                      $this->GTName => array( "threshold" => array( "type" => "mixed",
                                                                    "required" => true,
                                                                    "default" => false ) ),
                      $this->LEName => array( "threshold" => array( "type" => "mixed",
                                                                    "required" => true,
                                                                    "default" => false ) ),
                      $this->GEName => array( "threshold" => array( "type" => "mixed",
                                                                    "required" => true,
                                                                    "default" => false ) ) );
    }

    /*!
     Examines the input value and outputs a boolean value. See class documentation for more information.
    */
    function modify( &$element, &$tpl, &$op_name, &$op_params, &$namespace, &$current_nspace, &$value, &$named_params )
    {
        if ( $op_name == $this->LTName or $op_name == $this->GTName or
             $op_name == $this->LEName or $op_name == $this->GEName )
        {
            $val = $named_params["threshold"];
            if ( is_array( $val ) )
                $val_cnt = count( $val );
            else if ( is_object( $val ) and
                      method_exists( $val, "attributes" ) )
                $val_cnt = count( $val->attributes() );
            else if ( is_numeric( $val ) )
                $val_cnt = $val;
            else
            {
                $tpl->warning( $op_name, "Unsupported input type: " . gettype( $val ) . ", must be either array, attribute object or numerical" );
                return;
            }
        }
        switch ( $op_name )
        {
            case $this->TrueName:
            case $this->FalseName:
            {
                $value = ( $op_name == $this->TrueName );
            } break;
            case $this->EQName:
            {
                if ( count( $op_params ) >= 2 )
                {
                    $similar = false;
                    $value = true;
                    $lastOperand =& $tpl->elementValue( $op_params[0], $namespace );
                    for ( $i = 1; $i < count( $op_params ); ++$i )
                    {
                        $operand =& $tpl->elementValue( $op_params[$i], $namespace );
                        if ( $operand != $lastOperand )
                        {
                            $value = false;
                            break;
                        }
                        unset( $lastOperand );
                        $lastOperand =& $operand;
                    }
                }
                else
                {
                    $value = false;
                    $tpl->warning( $op_name, "Requires two or more parameters" );
                }
            } break;
            case $this->OrName:
            {
                for ( $i = 0; $i < count( $op_params ); ++$i )
                {
                    $operand = $tpl->elementValue( $op_params[$i], $namespace );
                    $operand_logic = false;
                    if ( is_array( $operand ) )
                        $operand_logic = count( $operand ) > 0;
                    else if ( is_numeric( $operand ) )
                        $operand_logic = $operand != 0;
                    else if ( is_null( $operand ) )
                        $operand_logic = false;
                    else if ( is_object( $operand ) )
                        $operand_logic = ( method_exists( $operand, "attributes" ) and
                                           method_exists( $operand, "attribute" ) );
                    if ( $operand_logic )
                    {
                        $value = $operand;
                        return;
                    }
                }
                $value = false;
            } break;
            case $this->AndName:
            {
                $operand = null;
                for ( $i = 0; $i < count( $op_params ); ++$i )
                {
                    $operand = $tpl->elementValue( $op_params[$i], $namespace );
                    $operand_logic = false;
                    if ( is_array( $operand ) )
                        $operand_logic = count( $operand ) > 0;
                    else if ( is_numeric( $operand ) )
                        $operand_logic = $operand != 0;
                    else if ( is_null( $operand ) )
                        $operand_logic = false;
                    else if ( is_object( $operand ) )
                        $operand_logic = ( method_exists( $operand, "attributes" ) and
                                           method_exists( $operand, "attribute" ) );
                    if ( !$operand_logic )
                    {
                        $value = false;
                        return;
                    }
                }
                $value = $operand;
            } break;
            case $this->ChooseName:
            {
                if ( is_array( $value ) or
                     ( is_object( $value ) and
                       method_exists( $value, "attributes" ) ) )
                {
                    $tpl->error( $op_name, "Only supports numeric and boolean values" );
                    return;
                }
                else if ( is_numeric( $value ) )
                    $index = $value;
                else if ( is_null( $value ) )
                    $index = 0;
                else
                    $index = $value ? 1 : 0;
                if ( $index < 0 or
                     $index > count( $op_params ) )
                {
                    $tpl->error( $op_name, "Index $index out of range" );
                    return;
                }
                $value = $tpl->elementValue( $op_params[$index], $namespace );
            } break;
            case $this->LTName:
            case $this->GTName:
            case $this->LEName:
            case $this->GEName:
            {
                if ( is_array( $value ) )
                    $cnt = count( $value );
                else if ( is_object( $value ) and
                          method_exists( $value, "attributes" ) )
                    $cnt = count( $value->attributes() );
                else if ( is_numeric( $value ) )
                    $cnt = $value;
                else
                {
                    $tpl->warning( $op_name, "Unsupported type: " . gettype( $value ) . ", must be either array, attribute object or numerical" );
                    return;
                }
                if ( $op_name == $this->LTName )
                    $value = ( $cnt < $val_cnt );
                else if ( $op_name == $this->GTName )
                    $value = ( $cnt > $val_cnt );
                else if ( $op_name == $this->LEName )
                    $value = ( $cnt <= $val_cnt );
                else if ( $op_name == $this->GEName )
                    $value = ( $cnt >= $val_cnt );
            } break;
            case $this->NullName:
            {
                $value = is_null( $value );
            } break;
            case $this->NotName:
            {
                if ( is_array( $value ) )
                    $value = ( count( $value ) == 0 );
                else if ( is_object( $value ) and
                          method_exists( $value, "attributes" ) )
                    $value = ( count( $value->attributes() ) == 0 );
                else if ( is_numeric( $value ) )
                    $value = ( $value == 0 );
                else
                    $value = !$value;
            } break;
        }
    }

    /// The array of operators
    var $Operators;
    /// The "less than" name
    var $LTName;
    /// The "greater than" name
    var $GTName;
    /// The "less than or equal" name
    var $LEName;
    /// The "greater than or equal" name
    var $GEName;
    /// The "equal" name
    var $EQName;
    /// The "null" name
    var $NullName;
    /// The "not" name
    var $NotName;
    /// The "or" name
    var $OrName;
    /// The "and" name
    var $AndName;
    /// The "true" name
    var $TrueName;
    /// The "false" name
    var $FalseName;
    /// The "choose" name
    var $ChooseName;
};

?>

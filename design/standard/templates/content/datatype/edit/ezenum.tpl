{switch match=$attribute.content.enum_ismultiple}
  {case match=1}
      {switch match=$attribute.content.enum_isoption}
        {case match=0}
          {section name=EnumList loop=$attribute.content.enum_list sequence=array(bglight,bgdark)}
            <input type="hidden" name = "ContentObjectAttribute_data_enumid_{$attribute.id}[]" value="{$EnumList:item.id}">  
            <input type="hidden" name = "ContentObjectAttribute_data_enumvalue_{$attribute.id}[]" value="{$EnumList:item.enumvalue}">  
	    <input type ="hidden" name = "ContentObjectAttribute_data_enumelement_{$attribute.id}[]" value="{$EnumList:item.enumelement}"> 
	    <input type = "checkbox" name = "ContentObjectAttribute_select_data_enumelement_{$attribute.id}[]" value="{$EnumList:item.enumelement}" 
	  {section name=EnumObjectList loop=$attribute.content.enumobject_list}
          {switch match=$EnumList:item.enumelement}
            {case match=$EnumList:EnumObjectList:item.enumelement}
	       checked
            {/case}
	  {/switch} 
	  {/section}
	    >{$EnumList:item.enumelement} <br />
	  {/section}
       {/case}
       {case match=1}
          {section name=EnumList loop=$attribute.content.enum_list sequence=array(bglight,bgdark)}
	  <input type="hidden" name = "ContentObjectAttribute_data_enumid_{$attribute.id}[]" value="{$EnumList:item.id}">  
          <input type="hidden" name = "ContentObjectAttribute_data_enumvalue_{$attribute.id}[]" value="{$EnumList:item.enumvalue}">
	  <input type ="hidden" name = "ContentObjectAttribute_data_enumelement_{$attribute.id}[]" value="{$EnumList:item.enumelement}"> 
	  {/section} 
	  <select name = "ContentObjectAttribute_select_data_enumelement_{$attribute.id}[]" size=4 multiple>
	  {section name=EnumList loop=$attribute.content.enum_list sequence=array(bglight,bgdark)}
	    <option name = "ContentObjectAttribute_data_enumelement_{$attribute.id}[]" value="{$EnumList:item.enumelement}">{$EnumList:item.enumelement}</option>
	  {/section}	  
	  </select>
       {/case}
     {/switch} 
  {/case}
  {case match=0}
      {switch match=$attribute.content.enum_isoption}
        {case match=0}
          {section name=EnumList loop=$attribute.content.enum_list sequence=array(bglight,bgdark)}
	    <input type="hidden" name = "ContentObjectAttribute_data_enumid_{$attribute.id}[]" value="{$EnumList:item.id}">
	    <input type="hidden" name = "ContentObjectAttribute_data_enumvalue_{$attribute.id}[]" value="{$EnumList:item.enumvalue}">  
	    <input type ="hidden" name ="ContentObjectAttribute_data_enumelement_{$attribute.id}[]" value="{$EnumList:item.enumelement}">
	    <input type = "radio" name = "ContentObjectAttribute_select_data_enumelement_{$attribute.id}[]" value="{$EnumList:item.enumelement}" 
          {section name=EnumObjectList loop=$attribute.content.enumobject_list}
          {switch match=$EnumList:item.enumelement}
            {case match=$EnumList:EnumObjectList:item.enumelement}
	       checked
            {/case}
          {/switch} 
          {/section}
            >{$EnumList:item.enumelement} <br />
          {/section}
        {/case}
        {case match=1}
	  {section name=EnumList loop=$attribute.content.enum_list sequence=array(bglight,bgdark)}
	    <input type="hidden" name = "ContentObjectAttribute_data_enumid_{$attribute.id}[]" value="{$EnumList:item.id}">  
            <input type="hidden" name = "ContentObjectAttribute_data_enumvalue_{$attribute.id}[]" value="{$EnumList:item.enumvalue}">  
	    <input type ="hidden" name = "ContentObjectAttribute_data_enumelement_{$attribute.id}[]" value="{$EnumList:item.enumelement}">
	  {/section}
          <select name = "ContentObjectAttribute_select_data_enumelement_{$attribute.id}[]">
	  {section name=EnumList loop=$attribute.content.enum_list sequence=array(bglight,bgdark)}
	    <option name = "ContentObjectAttribute_data_enumelement_{$attribute.id}[]" value="{$EnumList:item.enumelement}">{$EnumList:item.enumelement}</option>
	  {/section}
	  </select>
        {/case}
      {/switch} 
   {/case}
{/switch}
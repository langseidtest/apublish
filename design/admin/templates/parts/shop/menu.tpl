{* DESIGN: Header START *}<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">

<h4>{'Shop'|i18n( 'design/admin/parts/shop/menu' )}</h4>

{* DESIGN: Header END *}</div></div></div></div></div></div>

{* DESIGN: Content START *}<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-bl"><div class="box-br"><div class="box-content">

{section show=eq( $ui_context, 'edit' )}

<ul>
    <li><span class="disabled">{'Customers'|i18n( 'design/admin/parts/shop/menu' )}</span></li>
    <li><span class="disabled">{'Discounts'|i18n( 'design/admin/parts/shop/menu' )}</span></li>
    <li><span class="disabled">{'Orders'|i18n( 'design/admin/parts/shop/menu' )}</span></li>
    <li><span class="disabled">{'Product statistics'|i18n( 'design/admin/parts/shop/menu' )}</span></li>
    <li><span class="disabled">{'VAT types'|i18n( 'design/admin/parts/shop/menu' )}</span></li>
</ul>

{section-else}

<ul>
    <li><a href={'/shop/customerlist/'|ezurl}>{'Customers'|i18n( 'design/admin/parts/shop/menu' )}</a></li>
    <li><a href={'/shop/discountgroup/'|ezurl}>{'Discounts'|i18n( 'design/admin/parts/shop/menu' )}</a></li>
    <li><a href={'/shop/orderlist/'|ezurl}>{'Orders'|i18n( 'design/admin/parts/shop/menu' )}</a></li>
    <li><a href={'/shop/statistics/'|ezurl}>{'Product statistics'|i18n( 'design/admin/parts/shop/menu' )}</a></li>
    <li><a href={'/shop/vattype/'|ezurl}>{'VAT types'|i18n( 'design/admin/parts/shop/menu' )}</a></li>
</ul>

{/section}

{* DESIGN: Content END *}</div></div></div></div></div></div>
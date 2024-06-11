<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
}

function sidebar($product_id) {
?>

<div v-cloak>
    <aside class="product-information">
        <h1 v-if="sign.name" class="product-name">{{sign.name}}</h1>
        <?php
	    $product_material = get_post_meta( $product_id, 'product_material', true) ? get_post_meta( $product_id, 'product_material', true) : "none";
		$product_color = get_post_meta( $product_id, 'product_color', true) ? get_post_meta( $product_id, 'product_color', true) : "none";
		
		if($product_material && $product_color) {
			$get_material = 'material_'.strtolower( $product_material );
			$get_color = 'variant_'.strtolower( $product_color );
        ?>
        <div class="product-material">
	        <?php
		        if(function_exists('translate_materials_and_color')) {
			        $material = translate_materials_and_color($get_material);
			        $color = translate_materials_and_color($get_color);
			        $product_spec_output = '';
			        if($material) {
				        // Material
				        $product_spec_output .= '<span>' . $material . '</span>';
			        }
			        if($color) {
				        // Color
				        $product_spec_output .= ', <span class="product-variant">' . $color . '</span>';	   				        
			        }
			        echo $product_spec_output;
		        }
		    ?>
	    </div>
	    <?php } ?>
        <div v-if="sign.realwidth && sign.realheight" class="product-size"><span>{{sign.realwidth}}</span> x <span>{{sign.realheight}}</span> mm</div>
    </aside>

    <div class="product-layout-options">
        <div class="control-group-title"><?php pll_e('Text i skylt'); ?></div>
		<?php // echo '<button @click.prevent="exportToSvg">Export SVG</button>'; ?>
        <?php // v-model="linesData[index-1][0].text" @input="updateOrderObject" ?>
        <aside class="control order-textrows">
			<div v-for="index in Number(sign.rowsnum)" :key="index" class="form-group linehandler textrow" :class="index > 2 && showAllLines ? 'is-hidden' : ''">
				<input type="text" :id="'row'+index" :name="'row'+index" placeholder="<?php pll_e('Skriv in din text'); ?>" class="input text"  @input="handleInputChange" v-model="textrows[index-1]">
			</div>
            <button type="button" v-if="showAllLines && Number(sign.rowsnum) > 1" class="add-row-button" @click="showAllLines = false"><?php pll_e('Fler textrader'); ?></button>
        </aside>
        
        <div class="control-group-title"></div>

		<aside v-if="visualFontsViewer" class="control font-variant">
            <div class="form-group">
                <label for="font_all" class="control-group-title"><?php pll_e('Typsnitt'); ?></label>
                <div>
	                
					<div id="font_all" name="font_all" class="font">
						<div class="font-item" :class="font.slug == fontvariant.slug ? 'active' : ''" v-for="(fontvariant, index) in appfonts" :key="index">
							<button role="button" :class="fontvariant.slug" @click.prevent="font = fontvariant, updateOrderObject">{{fontvariant.name}}</button>
						</div>
					</div>

                </div>
            </div>
        </aside>

        <aside v-if="!visualFontsViewer" class="control font-variant">
	        <div class="form-group">
		        <label for="font_all" class="control-group-title"><?php pll_e('Typsnitt'); ?></label>
		        <div class="select is-fullwidth">
			        <select id="font_all" name="font_all" class="font" @change="handleSelectChange('font', $event)">
				        <option class="font-item" v-for="(fontvariant, index) in appfonts" :key="index" :value="JSON.stringify(fontvariant)" :selected="fontvariant.slug === order.font.slug">
				        	{{ fontvariant.name }}
				        </option>
					</select>
				</div>
			</div>
		</aside>
        
        <aside v-if="visualTextSizeViewer" class="control font-size">
            <div class="form-group">
                <label for="fontsize_all fontsize" class="control-group-title"><?php pll_e('Textstorlek'); ?></label>
                <div class="">
					
					<div id="fontsize_all" class="sizes">
						<div class="textsize-item" :class="textsize == size.truesize ? 'active' : ''" v-for="(size, index) in sizes" :key="index">
							<button role="button" @click.prevent="textsize = size.truesize, updateOrderObject" :data-size="size.truesize">{{size.name}} mm</button>
						</div>
					</div>
         
                </div>
            </div>
        </aside>

 		<aside v-if="!visualTextSizeViewer" class="control font-size">
			<div class="form-group">
				<label for="fontsize_all fontsize" class="control-group-title"><?php pll_e('Textstorlek'); ?></label>
				<div class="select is-fullwidth">
					<select id="fontsize_all" name="fontsize_all" @change="handleSelectChange('textsize', $event)">
						<option v-for="(size, index) in sizes" :key="index" :value="size.truesize" :selected="Number(size.truesize) === order.fontsize">
							{{size.name}} mm <template v-if="size.fee && size.fee > 0 && settings.currency">(+{{size.fee}} {{settings.currency}})</template>
						</option>
					</select>
				</div>
			</div>
		</aside>
        
        <aside class="control font-weight-style is-hidden">
            <div class="text-layout-options">
                <button v-if="font.bold" type="button" title="Fet text" class="button button-bold is-fullwidth mt-2" @click='fontbold = !fontbold, handleSelectChange()' :class="fontbold ? 'active' : ''"><span class="button-badge">B</span> <span class="is-sr-only"><?php pll_e('Fet text'); ?></span></button>
                <button v-if="font.italic" type="button" title="Italic text" class="button button-italic is-fullwidth mt-2" @click='fontitalic = !fontitalic, handleSelectChange()' :class="fontitalic ? 'active' : ''"><span class="button-badge">I</span> <span class="is-sr-only"><?php pll_e('Kursiv'); ?></span></button>
            </div>
        </aside>
		
        <aside class="product-delivery-info">
            <ul>
                <li><div v-if="!producOutOfStock" class="product-promises-item stock-availability"><?php pll_e('Finns i lager'); ?></div></li>
                <li><div v-if="producOutOfStock" class="product-promises-item stock-availability out-of-stock"><?php pll_e('Slut i lager'); ?></div></li>
                <li v-if="onlyLaser || sign.productmaterial === 'Plastic'" class="product-promises-item">
                	<?php pll_e('Lasergravyr'); ?>
                </li>
				<li v-else class="product-promises-item">
					<span v-if="(textsize < 24)"><?php pll_e('Lasergravyr'); ?></span>
					<span v-else="!onlyLaser && (textsize < 24)"><?php pll_e('Lackfylld djupgravyr'); ?></span>
				</li>
				<template v-for="(interfaceItem, index) in signInterface" :key="index">
	                <li>
	                	<div v-if="interfaceItem === 'sign_interface_tape'" class="product-promises-item tape-included"><?php pll_e('Dubbelhäftande tejp'); ?></div>
	                	<div v-if="interfaceItem === 'sign_interface_militaryclip'" class="product-promises-item militaryclip-included"><?php pll_e('Militärfäste'); ?></div>
	                	<div v-if="interfaceItem === 'sign_interface_screws'" class="product-promises-item screws-included"><?php pll_e('Skruvar ingår'); ?></div>
	                	<div v-if="interfaceItem === 'sign_interface_safetypin'" class="product-promises-item safetypin-included"><?php pll_e('Säkerhetsnål'); ?></div>
	                	<div v-if="interfaceItem === 'sign_interface_metalmagnet'" class="product-promises-item militaryclip-included"><?php pll_e('Magnet metall'); ?></div>
	                	<div v-if="interfaceItem === 'sign_interface_plasticmagnet'" class="product-promises-item militaryclip-included"><?php pll_e('Magnet plast'); ?></div>
	                	<div v-if="interfaceItem === 'sign_interface_keyring'" class="product-promises-item militaryclip-included"><?php pll_e('Nyckelring'); ?></div>
	                </li>
				</template>
            </ul>
        </aside>
    </div>
    
    <aside class="fast-tools">
	    <div>
			<div :class="font.italic ? '' : 'disabled'">
				<button :disabled="!font.italic" role="button" class="button is-small button-italic" @click.prevent='fontitalic = !fontitalic, handleSelectChange()' :class="fontitalic ? 'active' : ''"><span>I</span><span class="sr-only"><?php pll_e('Kursiv'); ?></span></button>
			</div>
			
			<div :class="font.bold ? '' : 'disabled'">
				<button :disabled="!font.bold" role="button" class="button is-small button-bold" @click.prevent='fontbold = !fontbold, handleSelectChange()' :class="fontbold ? 'active' : ''"><span>B</span><span class="sr-only"><?php pll_e('Fet text'); ?></span></button>
			</div>
			
			<div>
				<button role="button" class="button is-small button-uppercase" @click.prevent='uppercase = !uppercase, handleSelectChange()' :class="uppercase ? 'active' : ''"><span class="sr-only"><?php pll_e('Versaler'); ?></span></button>
			</div>
			
			<div v-if="hasSavedData">
				<button title="Rensa" class="button is-small button-delete" @click.prevent="clearSavedDesign"><span class="sr-only"><?php pll_e('Rensa'); ?></span></button>
			</div>

			<div v-if="showTextAlignment" class="toolbar-separator"><div></div></div>
			
			<div v-if="showTextAlignment">
				<button role="button" class="button is-small button-align-left" @click.prevent="textalign = 'left', handleSelectChange()" :class="textalign == 'left' ? 'active' : ''">
					<span class="icon"></span>
					<span class="sr-only"><?php pll_e('Vänsterställd text'); ?></span>
				</button>
			</div>
			
			<div v-if="showTextAlignment">
				<button role="button" class="button is-small button-align-center" @click.prevent="textalign = 'center', handleSelectChange()" :class="textalign == 'center' ? 'active' : ''">
					<span class="sr-only"><?php pll_e('Centrera text'); ?></span>
				</button>
			</div>
			
			<div v-if="showTextAlignment"><button role="button" class="button is-small button-align-right" @click.prevent="textalign = 'right', handleSelectChange()" :class="textalign == 'right' ? 'active' : ''"><span class="sr-only"><?php pll_e('Högerställd text'); ?></span></button></div>
			
			<div v-if="showLineHeight">
				<select class="form-control" name="lineheight" v-model="textspacingy" @change="updateOrderObject">
					<option value="3">0</option>
					<option value="10">1</option>
					<option value="20">2</option>
					<option value="30">3</option>
					<option value="40">4</option>
					<option value="50">5</option>
				</select>
			</div>
	
	        <div v-if="showTextAlignment && textalign == 'left'">
		        <div class="toolbar-item toolbar-item-align-left">
					<label><input type="number" placeholder="0 mm" v-model="offset" @change="updateOrderObject"> mm</label>
		        </div>
	        </div>			
	
			<div v-if="showTextAlignment && textalign == 'right'">
				<div class="toolbar-item toolbar-item-align-right">
					<label><input type="number" placeholder="0 mm" v-model="offset" @change="updateOrderObject"> mm</label>
				</div>
			</div>
			
	    </div>
    </aside>
</div>

<?php
}
import { useState } from 'react';

import { ReactComponent as SlopeUp } from './shapes/slope-up.svg';
import { v4 as uuidv4 } from 'uuid';
const { registerBlockType } = wp.blocks;
const {
     useBlockProps,
     InnerBlocks,
     InspectorControls,
     ColorPalette
} = wp.blockEditor;
const { 
     PanelBody,
     Dropdown,
     MenuItem,
     MenuGroup,
     Button,
     RangeControl
} = wp.components;
import SE2_container from '../components/container';

registerBlockType('se2block/section', {

     "apiVersion": 2,
     title: 'Section',
     description: 'Create and design your custom container',
     icon: 'star-filled',
     category: 'se2',

     //attributes
     attributes: {
          containerstyle: { type: 'object' },
          style: { type: 'object', default: {} },
          shapetop: { type: 'string', default: 'none' },
          shapetopcolor: { type: 'string', default: '#ffffff' },
          shapetopdimensions: { type: 'object', default: { width: 100, height: 100 } },
          shapebottom: { type: 'string', default: 'none' },
          shapebottomcolor: { type: 'string', default: '#ffffff' },
          shapebottomdimensions: { type: 'object', default: { width: 100, height: 100 } }
     },

     //built-in functions
     edit({ attributes, setAttributes }) {
          let styleProps;
          if (attributes.containerstyle) {
               styleProps = attributes.containerstyle
          } else {
               styleProps = {}
          }
          const uuid = uuidv4();
          function containerStyle(e, style) {
               setAttributes({
                    containerstyle: e,
                    style: style
               });
          }
          const shapes = [
               {
                    name: 'Slope Up',
                    slug: 'slopeUp',
                    svg: <polygon className={`shape-${uuid}`} points="0,100 0,0 500,0" />
               },
               {
                    name: 'Slope Down',
                    slug: 'slopeDown',
                    svg: <polygon className={`shape-${uuid}`} points="0,0 500,0 500,100" />
               }
          ]
          function handleShapeChange(e, position) {
               if (position === 'top') {
                    setAttributes({ shapetop: e.target.getAttribute('shape') })
               }
               if (position === 'bottom') {
                    setAttributes({ shapebottom: e.target.getAttribute('shape') })
               }
               for (const li of e.target.parentNode.childNodes) {
                    li.style.backgroundColor = 'white'
               }
               //.map(li => { })
               e.target.style.backgroundColor = 'lightgrey'
               console.log(attributes)
          }

          function handleShapeColor(e, position) {
               console.log(attributes)
               if (position === 'top') {
                    setAttributes({ shapetopcolor: e })
               }
               if (position === 'bottom') {
                    setAttributes({ shapebottomcolor: e })
               }
          }
          function handleShapeDimenstion(e, position, dir) {
               console.log(attributes)

               if (position === 'top') {
                    const dimension = { ...attributes.shapetopdimensions }
                    dimension[dir] = e;
                    setAttributes({ shapetopdimensions: dimension })
               }
               if (position === 'bottom') {
                    const dimension = { ...attributes.shapebottomdimensions }
                    dimension[dir] = e;
                    setAttributes({ shapebottomdimensions: dimension })
               }
          }

          const blockProps = useBlockProps();

          return (
               <>
                    <InspectorControls style={{ marginBottom: '40px' }} >

                         <PanelBody title={'Block Shape'} initialOpen={false} >
                              <p><strong>Top Shape</strong></p>
                              <MenuGroup style={{ width: '50%' }}>
                                   <ul>
                                        {
                                             shapes.map(shape => {
                                                  const isActive = (shape.slug === attributes.shapetop) ? 'lightgrey' : 'white';
                                                  return (
                                                       <li shape={shape.slug} onClick={e => { handleShapeChange(e, 'top'); }} style={{ backgroundColor: isActive }}>
                                                            {shape.name}
                                                            <div style={{ width: '50px' }}>
                                                                 <svg width="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 100">
                                                                      {shape.svg}
                                                                 </svg>
                                                            </div>
                                                       </li>
                                                  )
                                             })
                                        }
                                   </ul>
                              </MenuGroup>
                              <ColorPalette
                                   value={attributes.shapetopcolor}
                                   onChange={(value) => handleShapeColor(value, 'top')}
                              />
                              <RangeControl
                                   label="Width in %"
                                   value={attributes.shapetopdimensions.width}
                                   onChange={(width) => handleShapeDimenstion(width, 'top', 'width')}
                                   min={100}
                                   max={1000}
                              />
                              <RangeControl
                                   label="Height in %"
                                   value={attributes.shapetopdimensions.height}
                                   onChange={(height) => handleShapeDimenstion(height, 'top', 'height')}
                                   min={5}
                                   max={500}
                              />
                         </PanelBody>

                    </InspectorControls>
                    <div {...blockProps}>

                         <SE2_container
                           
                              key={'edit'}
                              styleHandler={containerStyle}
                              styleProps={styleProps}
                         >
                              {
                                   attributes.shapetop !== 'none' &&
                                   <div style={{ overflow: 'hidden', position: 'absolute', top: '0', height: 'fit-content', width: '100%', left: '0', right: '0', margin: 'auto', display: 'flex' }}>
                                        <svg width="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 100" style={{
                                             transform: `scale(${attributes.shapetopdimensions.width}%, ${attributes.shapetopdimensions.height}%)`,
                                             webkitTransform: `scale(${attributes.shapetopdimensions.width}%, ${attributes.shapetopdimensions.height}%)`,
                                             transformOrigin: 'top center',
                                        }}>
                                             <style dangerouslySetInnerHTML={{
                                                  __html: `
                                                  .shape-${uuid} {fill: ${attributes.shapetopcolor} !important}
                                             `}} />

                                             {shapes.find(thisShape => thisShape.slug === attributes.shapetop)['svg']}
                                        </svg>
                                   </div>
                              }
                              <InnerBlocks allowedBlocks={true} renderAppender={InnerBlocks.ButtonBlockAppender} />
                         </SE2_container>
                    </div>
               </>
          );
     },

     save({ attributes, setAttributes }) {
          const blockProps = useBlockProps.save();

          return (
               <div {...blockProps} >

                    <div style={attributes.style}>
                         <InnerBlocks.Content style={{ maxWidth: '100%' }} />
                    </div>
               </div>
          )
     },

     deprecated: [
          {
               attributes: {},

               save({ attributes, setAttributes }) {
                    return (
                         <div  >
                              <div style={attributes.style}>
                                   <InnerBlocks.Content style={{ maxWidth: '100%' }} />
                              </div>
                         </div>
                    );
               },
          }
     ]
});


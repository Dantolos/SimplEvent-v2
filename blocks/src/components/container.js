import React, { Component, useState } from 'react';

import {
     __experimentalBoxControl as BoxControl,

} from '@wordpress/components';
 
const {
     RichText,
     InspectorControls,
     ColorPalette,
     MediaUpload,
     MediaUploadCheck
} = wp.blockEditor;
const { PanelBody, ColorPicker, SelectControl, Button } = wp.components;

export default class SE2_container extends Component {

     constructor(props) {
          super(props)
          let defaultStyle = {
               style: {},
               margin: {},
               padding: {},
               backgroundColor: 'none',
               borderWidth: {},
               borderStyle: 'solid',
               borderColor: '#ffffff',
               borderRadius: {},
               backgroundImage: 'none',
               backgroundSize: 'cover',
               backgroundRepeat: 'no-repeat',
               backgroundAttachment: 'scroll',
               backgroundPosition: 'center'
          }
          if (Object.values(this.props.styleProps).length > 0) {
               this.state = this.props.styleProps
          } else {
               this.state = defaultStyle;
          }
          if (this.changeSettings) {
               this.changeSettings = this.changeSettings.bind(this)

          }
          this.props.SE2containerStyle = {};
     }

     changeSettings(v, k) {
          this.setState(
               (prevState) => {
                    var newState = Object.assign({}, prevState);
                    newState[k] = v
                    return newState;
               },
               () => { this.props.styleHandler(this.state, this.props.SE2containerStyle) }
          )
     }

     componentDidMount() {
          this.changeSettings(this.props.SE2containerStyle, 'style')
     }

     render() {
          var margin = '0px'
          if (this.state.margin.top) {
               margin = this.state.margin.top + ' ' + this.state.margin.right + ' ' + this.state.margin.bottom + ' ' + this.state.margin.left
          }
          var padding = '0px'
          if (this.state.padding.top) {
               padding = this.state.padding.top + ' ' + this.state.padding.right + ' ' + this.state.padding.bottom + ' ' + this.state.padding.left
          }
          var borderWidth = '0px'
          if (this.state.borderWidth.top) {
               borderWidth = this.state.borderWidth.top + ' ' + this.state.borderWidth.right + ' ' + this.state.borderWidth.bottom + ' ' + this.state.borderWidth.left
          }
          var borderRadius = '0px'
          if (this.state.borderRadius.top) {
               borderRadius = this.state.borderRadius.top + ' ' + this.state.borderRadius.right + ' ' + this.state.borderRadius.bottom + ' ' + this.state.borderRadius.left
          }
          var backgroundImage = 'none'
          if (this.state.backgroundImage !== 'none') {
               backgroundImage = `url(${this.state.backgroundImage.sizes.full.url})`
          }
          this.props.SE2containerStyle = {
               backgroundColor: this.state.backgroundColor,
               margin: margin,
               padding: padding,
               borderWidth: borderWidth,
               borderStyle: this.state.borderStyle,
               borderColor: this.state.borderColor,
               borderRadius: borderRadius,
               backgroundImage: backgroundImage,
               backgroundSize: this.state.backgroundSize,
               backgroundRepeat: this.state.backgroundRepeat,
               backgroundAttachment: this.state.backgroundAttachment,
               backgroundPosition: this.state.backgroundPosition
          }

          return ([
               <InspectorControls style={{ marginBottom: '40px' }}>
                    <PanelBody title={'Background'} initialOpen={false} >
                         <ColorPalette
                              value={this.state.backgroundColor}
                              onChange={(value) => this.changeSettings(value, 'backgroundColor')}

                         />
                         <p><strong>Background Image</strong></p>
                         <MediaUploadCheck style={{ margin: '40px 0' }}>
                              <MediaUpload
                                   onSelect={(media) =>
                                        this.changeSettings(media, 'backgroundImage')
                                   }

                                   value={this.state.backgroundImage}
                                   render={({ open }) => (
                                        <div>
                                             {
                                                  this.state.backgroundImage !== 'none'
                                                       ? <div style={{ margin: '20px 0', backgroundImage: `url(${this.state.backgroundImage.sizes.full.url})`, height: '100px', width: '100%', backgroundSize: 'cover' }}></div>
                                                       : <div style={{ margin: '20px 0', color: 'grey', backgroundColor: 'lightgrey', width: '100%', textAlign: 'center', padding: '10px' }}><strong>No Image</strong></div>
                                             }

                                             <Button isPrimary onClick={open}>Select Background Image</Button>
                                        </div>
                                   )}
                              />
                         </MediaUploadCheck>
                         <SelectControl
                              label={'Background Size'}
                              value={this.state.backgroundSize} // e.g: value = [ 'a', 'c' ]
                              onChange={value => { this.changeSettings(value, 'backgroundSize') }}
                              options={[
                                   { value: 'cover', label: 'Cover' },
                                   { value: 'auto', label: 'Auto' },
                                   { value: 'contain', label: 'contain' },
                                   { value: '100%', label: '100%' },
                              ]}
                         />
                         <SelectControl
                              label={'Background Attechment'}
                              value={this.state.backgroundAttachment} // e.g: value = [ 'a', 'c' ]
                              onChange={value => { this.changeSettings(value, 'backgroundAttachment') }}
                              options={[
                                   { value: 'scroll', label: 'Scroll' },
                                   { value: 'fixed', label: 'Fixed' },
                                   { value: 'local', label: 'Local' },

                              ]}
                         />
                    </PanelBody>
                    <PanelBody title={'Spacing'} initialOpen={false}>
                         <BoxControl label="Margin" values={this.state.margin} onChange={value => { this.changeSettings(value, 'margin') }} />
                         <BoxControl label="Padding" values={this.state.padding} onChange={value => { this.changeSettings(value, 'padding') }} />
                    </PanelBody>
                    <PanelBody title={'Border'} initialOpen={false} >
                         <BoxControl label="Width" values={this.state.borderWidth} onChange={value => { this.changeSettings(value, 'borderWidth') }} />
                         <SelectControl
                              label={'Border Style'}
                              value={this.state.borderStyle} // e.g: value = [ 'a', 'c' ]
                              onChange={value => { this.changeSettings(value, 'borderStyle') }}
                              options={[
                                   { value: 'solid', label: 'Solid' },
                                   { value: 'dotted', label: 'Dotted' },
                                   { value: 'dashed', label: 'Dashed' },
                                   { value: 'double', label: 'Double' },
                                   { value: 'groove', label: 'Groove' },
                                   { value: 'ridge', label: 'Ridge' },
                                   { value: 'inset', label: 'Inset' },
                                   { value: 'outset', label: 'Outset' },
                              ]}
                         />
                         <ColorPalette
                              value={this.state.borderColor}
                              onChange={(value) => this.changeSettings(value, 'borderColor')}
                         />
                         <BoxControl label="Corner Radius" values={this.state.borderRadius} onChange={value => { this.changeSettings(value, 'borderRadius') }} />

                    </PanelBody>

               </InspectorControls>,

               <div className="se2-container" style={this.props.SE2containerStyle}>

                    {this.props.children}

               </div>
          ])
     }
}
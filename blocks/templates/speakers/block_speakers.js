
const { registerBlockType } = wp.blocks;

registerBlockType('se2block/speaker', {
     //biult-in attributes
     title: 'Speaker-Slider',
     description: 'aldsfjasldkfjaösdfj',
     icon: 'format-image',
     category: 'layout',
     

     //custom attributes
     attributes: {},

     //custom functions

     //built-in functions
     edit() {
          return <div>hello world</div>;
     },

     save() {},
});
wp.blocks.registerBlockType("theblocktheme/rightsidebar2", {
    title: "Right Sidebar (Ver. 2)",
    edit: function () {
        return wp.element.createElement("div", { className: "our-placeholder-block" }, "Placeholder For Right Sidebar (Ver. 2)")
    },
    save: function () {
        return null
    }
})
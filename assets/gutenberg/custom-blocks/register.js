/**
 * Dynamically locate, load & register all Editor Blocks & Plugins.
 * based on https://humanmade.com/2018/11/26/hot-module-replacement-for-gutenberg-blocks/
 */
import {
  registerBlockType,
  unregisterBlockType,
  getBlockType,
} from '@wordpress/blocks';
import { select, dispatch } from '@wordpress/data';

/**
 * No-op function for use as a default argument value.
 *
 * @return {null} null
 */
const noop = () => null;

/**
 * Require a set of modules and configure them for hot module replacement.
 *
 * The first argument should be a function returning a `require.context()`
 * call. All modules loaded from this context are cached, and on each rebuild
 * the incoming updated modules are checked against the cache. Updated modules
 * which already exist in the cache are unregistered with the provided function,
 * then any incoming (new or updated) modules will be registered.
 *
 * @param {Object}   p
 * @param {Function} p.getContext Execute and return a `require.context()` call.
 * @param {Function} p.register   Function to register accepted modules.
 * @param {Function} p.unregister Function to unregister replaced modules.
 * @param {Function} [p.before]   Function to run before updating moules.
 * @param {Function} [p.after]    Function to run after updating moules.
 */
const autoload = ({ getContext, register, before = noop, after = noop }) => {
  const cache = {};
  const loadModules = () => {
    before();

    const context = getContext();
    const changedNames = [];
    context.keys().forEach((key) => {
      const module = context(key);
      if (module === cache[key]) {
        // Module unchanged: no further action needed.
        return;
      }
      // Register new module and update cache.
      register(module);
      changedNames.push(module.name);
      cache[key] = module;
    });

    after(changedNames);

    // Return the context for HMR initialization.
    return context;
  };

  const context = loadModules();

  if (module.hot) {
    module.hot.accept(context.id, loadModules);
  }
};

// Maintain the selected block ID across HMR updates.
let selectedBlockId = null;
const storeSelectedBlock = () => {
  selectedBlockId = select('core/block-editor').getSelectedBlockClientId();
  dispatch('core/block-editor').clearSelectedBlock();
};
const refreshAllBlocks = (changedNames = []) => {
  // Refresh all blocks by iteratively selecting each one.
  select('core/block-editor')
    .getBlocks()
    .forEach(({ name, clientId }) => {
      if (changedNames.includes(name)) {
        dispatch('core/block-editor').selectBlock(clientId);
      }
    });
  // Reselect whatever was selected in the beginning.
  if (selectedBlockId) {
    dispatch('core/block-editor').selectBlock(selectedBlockId);
  } else {
    dispatch('core/block-editor').clearSelectedBlock();
  }
  selectedBlockId = null;
};

// Load all block index files.
autoload({
  getContext: () =>
    require.context('./.', true, /gutenberg\/custom-blocks\/.*\/index\.js$/),
  register: ({ name, settings }) => {
    const blockType = getBlockType(name);
    if (blockType) {
      unregisterBlockType(name);
    }
    registerBlockType(name, {
      ...blockType,
      ...settings,
    });
  },
  before: storeSelectedBlock,
  after: refreshAllBlocks,
});

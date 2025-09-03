import React from 'react';
import PropTypes from 'prop-types';

import './styles.scss';
import l10n from './l10n';

const ExampleComponent = (props) => {
  return (
    <div className={`custom-example-component`}>
      <span>{l10n.message}</span>
      {'title' in props && <h2>{props.title}</h2>}
      {'test' in props && <p>Test: {props.test ? 'true' : 'false'}</p>}
    </div>
  );
};

ExampleComponent.propTypes = {
  title: PropTypes.string,
  test: PropTypes.bool,
};

export default ExampleComponent;

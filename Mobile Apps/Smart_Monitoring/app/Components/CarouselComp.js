import React, {useRef, useState, useEffect} from 'react';
import Carousel, {ParallaxImage, Pagination } from 'react-native-snap-carousel';
import {
  View,
  Text,
  Dimensions,
  StyleSheet,
  TouchableOpacity,
  Platform, Image
} from 'react-native';

const ENTRIES1 = [
  {
    //title: 'Beautiful and dramatic Antelope Canyon',
    //subtitle: 'Lorem ipsum dolor sit amet et nuncat mergitur',
    //illustration: 'https://cdn.idntimes.com/content-images/duniaku/post/20200922/ultra-instinct-goku-sempurna-4e974ad358521c7a9cf2ea2a1354f450_600x400.jpg',
    illustration: require('../Images/1.jpeg'),
  },
  {
    //illustration: 'https://cdn.idntimes.com/content-images/duniaku/post/20200922/goku-great-ape-c388046cd7d38ec1be90c50d7e4e6c5c.jpg',
    illustration: require('../Images/2.jpeg'),
  },
  {
    //illustration: 'https://cdn.idntimes.com/content-images/duniaku/post/20200922/super-saiyan-1-goku-b4e90f5cd2c140e84242bd5c02ccacc0.jpg',
    illustration: require('../Images/3.jpeg'),
  },
  {
    //illustration: 'https://cdn.idntimes.com/content-images/duniaku/post/20200922/super-saiyan-2-goku-959009b243e2de27ce53c2438bccf493.png',
    illustration: require('../Images/4.jpeg'),
  },
  {
    //illustration: 'https://cdn.idntimes.com/content-images/duniaku/post/20200922/super-saiyan-3-goku-2325d6d220d4c2bfdf2fe55c134769aa.jpg',
    illustration: require('../Images/5.jpeg'),
  },
  {
    //illustration: 'https://cdn.idntimes.com/content-images/duniaku/post/20200922/super-saiyan-3-goku-2325d6d220d4c2bfdf2fe55c134769aa.jpg',
    illustration: require('../Images/6.jpeg'),
  },
];
const { width: screenWidth, height: screenHeight } = Dimensions.get('window')

const CarouselComp = props => {
  const [entries, setEntries] = useState([]);
  const carouselRef = useRef(null);
  const [index, setIndex] = useState(0)

  useEffect(() => {
    setEntries(ENTRIES1);
  }, []);

  const renderItem = ({item, index}, parallaxProps) => {
    return (
      <View style={styles.item}>
        <ParallaxImage
          //source={{uri: item.illustration}} // kalo pake url
          source={ item.illustration }
          containerStyle={styles.imageContainer}
          style={styles.image}
          parallaxFactor={0.4}
          {...parallaxProps}
        />
      </View>
    );
  };

  return (
    <View style={styles.container}>
      <Carousel
      loop={true}
      loopClonesPerSide = { 10 }
      autoplay={true}
      enableMomentum = {false}
      lockScrollWhileSnapping = {true}
      autoplayInterval={3000}
      layout={'default'}
        ref={carouselRef}
        sliderWidth={screenWidth}
        sliderHeight={screenWidth}
        itemWidth={screenWidth - 30}
        data={entries}
        renderItem={renderItem}
        hasParallaxImages={true}
        onSnapToItem={(index) => setIndex(index)}
      />

<View style={{ marginTop: -50}}>
<Pagination
        dotsLength={entries.length}
        activeDotIndex={index}
        dotStyle={{
          width: 10,
          height: 10,
          borderRadius: 5,
          marginHorizontal: 0,
          backgroundColor: 'rgba(0, 0, 0, 0.92)'
        }}
        inactiveDotOpacity={0.4}
        inactiveDotScale={0.6}
        tappableDots={false}
      />
      </View>

    </View>
  );
};

export default CarouselComp;

const styles = StyleSheet.create({
  container: {
  },
  item: {
    width: screenWidth - 30,
    height: 200,
  },
  imageContainer: {
    flex: 1,
    marginBottom: Platform.select({ios: 0, android: 1}), // Prevent a random Android rendering issue
    backgroundColor: 'white',
    borderRadius: 8,
  },
  image: {
    ...StyleSheet.absoluteFillObject,
    resizeMode: 'cover', //contain, stretch
  },
});